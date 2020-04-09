<?php

namespace Drupal\forum\Routing;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Render\BubbleableMetadata;
use Drupal\Core\RouteProcessor\OutboundRouteProcessorInterface;
use Symfony\Component\Routing\Route;

/**
 * Processes the outbound path by resolving it to the forum page.
 */
class RouteProcessor implements OutboundRouteProcessorInterface {

  /**
   * The config factory.
   *
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  protected $configFactory;

  /**
   * The entity type manager service.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * Constructs a RouteProcessor object.
   *
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   *   The config factory.
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entity_type_manager
   *   The entity type manager service.
   */
  function __construct(ConfigFactoryInterface $config_factory, EntityTypeManagerInterface $entity_type_manager) {
    $this->configFactory = $config_factory;
    $this->entityTypeManager = $entity_type_manager;
  }

  /**
   * {@inheritdoc}
   */
  public function processOutbound($route_name, Route $route, array &$parameters, BubbleableMetadata $bubbleable_metadata = NULL) {
    if ($route_name == 'entity.taxonomy_term.canonical' && !empty($parameters['taxonomy_term'])) {
      // Take over URI construction for taxonomy terms that belong to forum.
      if ($vid = $this->configFactory->get('forum.settings')->get('vocabulary')) {
        $term = $this->entityTypeManager->getStorage('taxonomy_term')->load($parameters['taxonomy_term']);
        if ($term && $term->getVocabularyId() == $vid) {
          $route->setPath('/forum/{taxonomy_term}');
        }
      }
    }
  }

}
