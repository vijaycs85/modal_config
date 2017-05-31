<?php

namespace Drupal\modal_config\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Path\PathValidatorInterface;
use Drupal\modal_config\ModalConfigInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

/**
 * Builds the page for administering shortcut sets.
 */
class ModalConfigController extends ControllerBase {

  /**
   * The path validator.
   *
   * @var \Drupal\Core\Path\PathValidatorInterface
   */
  protected $pathValidator;

  /**
   * Creates a new ModalConfigController instance.
   *
   * @param \Drupal\Core\Path\PathValidatorInterface $path_validator
   *   The path validator.
   */
  public function __construct(PathValidatorInterface $path_validator) {
    $this->pathValidator = $path_validator;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static($container->get('path.validator'));
  }

  /**
   * Creates a new link in the provided shortcut set.
   *
   * @param \Drupal\modal_config\ModalConfigInterface $shortcut_set
   *   The shortcut set to add a link to.
   * @param \Symfony\Component\HttpFoundation\Request $request
   *   The request object.
   *
   * @return \Symfony\Component\HttpFoundation\RedirectResponse
   *   A redirect response to the front page, or the previous location.
   *
   * @throws \Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException
   */
  public function addShortcutLinkInline(ModalConfigInterface $shortcut_set, Request $request) {
    $link = $request->query->get('link');
    $name = $request->query->get('name');
    if (parse_url($link, PHP_URL_SCHEME) === NULL && $this->pathValidator->isValid($link)) {
      $shortcut = $this->entityManager()->getStorage('shortcut')->create([
        'title' => $name,
        'modal_config' => $shortcut_set->id(),
        'link' => [
          'uri' => 'internal:/' . $link,
        ],
      ]);

      try {
        $shortcut->save();
        drupal_set_message($this->t('Added a shortcut for %title.', ['%title' => $shortcut->label()]));
      }
      catch (\Exception $e) {
        drupal_set_message($this->t('Unable to add a shortcut for %title.', ['%title' => $shortcut->label()]), 'error');
      }

      return $this->redirect('<front>');
    }

    throw new AccessDeniedHttpException();
  }

}
