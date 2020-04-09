<?php

namespace Drupal\Tests\image\Functional;

use Drupal\file\Entity\File;
use Drupal\Tests\TestFileCreationTrait;

/**
 * Tests the image field formatter.
 *
 * @group image
 */
class ImageFieldFormatterTest extends ImageFieldTestBase {

  use TestFileCreationTrait;

  /**
   * An authenticated user.
   *
   * @var \Drupal\user\Entity\User
   */
  protected $authUser;

  /**
   * {@inheritdoc}
   */
  protected $profile = 'standard';

  /**
   * A user with 'access user profiles' permission
   *
   * @var \Drupal\user\Entity\User
   */
  protected $profileUser;

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();
    $this->authUser = $this->drupalCreateUser();
    $this->profileUser = $this->drupalCreateUser(['access user profiles']);
  }

  /**
   * Tests link access check on image field formatter.
   */
  public function testImageFormatterAccess() {
    // Add a profile image.
    $this->drupalLogin($this->adminUser);

    // Save a new picture.
    $image = current($this->getTestFiles('image'));
    $this->saveUserPicture($image);

    // Create a node for the admin user.
    $node = $this->createNode([
      'type' => 'article',
      'title' => 'Article',
      'uid' => $this->adminUser->id(),
    ]);

    // Verify the link is present.
    $this->drupalGet($node->toUrl());
    $this->assertSession()->elementExists('css', 'article.profile .field--name-user-picture a');

    // Authenticated, with permission.
    $this->drupalLogin($this->profileUser);
    $this->drupalGet($node->toUrl());
    $this->assertSession()->elementExists('css', 'article.profile .field--name-user-picture a');

    // Authenticated, no permission.
    $this->drupalLogin($this->authUser);
    $this->drupalGet($node->toUrl());
    $this->assertSession()->elementExists('css', 'article.profile .field--name-user-picture');
    $this->assertSession()->elementNotExists('css', 'article.profile .field--name-user-picture a');

    // Anonymous.
    $this->drupalLogout();
    $this->drupalGet($node->toUrl());
    $this->assertSession()->elementExists('css', 'article.profile .field--name-user-picture');
    $this->assertSession()->elementNotExists('css', 'article.profile .field--name-user-picture a');
  }

  /**
   * Edits the user picture for the test user.
   */
  public function saveUserPicture($image) {
    $edit = ['files[user_picture_0]' => \Drupal::service('file_system')->realpath($image->uri)];
    $this->drupalPostForm('user/' . $this->adminUser->id() . '/edit', $edit, t('Save'));

    // Load actual user data from database.
    $user_storage = $this->container->get('entity.manager')->getStorage('user');
    $user_storage->resetCache([$this->adminUser->id()]);
    $account = $user_storage->load($this->adminUser->id());
    return File::load($account->user_picture->target_id);
  }

}
