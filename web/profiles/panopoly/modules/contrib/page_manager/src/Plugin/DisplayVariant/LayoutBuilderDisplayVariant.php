<?php

namespace Drupal\page_manager\Plugin\DisplayVariant;

use Drupal\Core\Display\VariantBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\ctools\Plugin\PluginWizardInterface;
use Drupal\layout_builder\LayoutEntityHelperTrait;
use Drupal\layout_builder\SectionStorage\SectionStorageTrait;
use Drupal\page_manager\Form\LayoutBuilderForm;

/**
 * Provides a Layout Builder variant.
 *
 * @DisplayVariant(
 *   id = "layout_builder",
 *   admin_label = @Translation("Layout Builder")
 * )
 */
class LayoutBuilderDisplayVariant extends VariantBase implements PluginWizardInterface {

  use SectionStorageTrait;
  use LayoutEntityHelperTrait;

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = [];
    foreach ($this->getSections() as $delta => $section) {
      $build[$delta] = $section->toRenderArray();
    }
    return $build;
  }

  public function defaultConfiguration() {
    return parent::defaultConfiguration() + [
      'sections' => [],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state) {
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function getWizardOperations($cached_values) {
    $operations = [];
    $operations['layout_builder'] = [
      'title' => $this->t('Layout'),
      'form' => LayoutBuilderForm::class,
    ];

    return $operations;
  }

  /**
   * {@inheritdoc}
   */
  protected function setSections(array $sections) {
    $this->configuration['sections'] = array_values($sections);
  }

  /**
   * {@inheritdoc}
   */
  public function getSections() {
    if (!isset($this->configuration['sections'])) {
      $this->configuration['sections'] = [];
    }
    return $this->configuration['sections'];
  }

  /**
   * Returns instance of the layout plugin used by this page variant.
   *
   * @return \Drupal\Core\Layout\LayoutInterface
   *   A layout plugin instance.
   */
  public function getLayout() {
    if (!isset($this->layout)) {
      $this->layout = $this->layoutManager->createInstance($this->configuration['layout'], $this->configuration['layout_settings']);
    }
    return $this->layout;
  }

}
