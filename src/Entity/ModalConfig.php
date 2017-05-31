<?php

namespace Drupal\modal_config\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;
use Drupal\Core\Config\Entity\ConfigEntityInterface;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\modal_config\ModalConfigInterface;

/**
 * Defines the Shortcut set configuration entity.
 *
 * @ConfigEntityType(
 *   id = "modal_config",
 *   label = @Translation("Modal configuration"),
 *   handlers = {
 *     "storage" = "Drupal\modal_config\ModalConfigStorage",
 *     "access" = "Drupal\modal_config\ModalConfigAccessControlHandler",
 *     "list_builder" = "Drupal\modal_config\ModalConfigListBuilder",
 *     "form" = {
 *       "default" = "Drupal\modal_config\ModalConfigForm",
 *       "add" = "Drupal\modal_config\ModalConfigForm",
 *       "edit" = "Drupal\modal_config\ModalConfigForm",
 *       "delete" = "Drupal\modal_config\Form\ModalConfigDeleteForm"
 *     }
 *   },
 *   config_prefix = "form",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "config_key" = "config_key",
 *     "config_value" = "config_value"
 *   },
 *   links = {
 *     "customize-form" = "/admin/config/user-interface/modal-config/manage/{modal_config}/customize",
 *     "delete-form" = "/admin/config/user-interface/modal-config/manage/{modal_config}/delete",
 *     "edit-form" = "/admin/config/user-interface/modal-config/manage/{modal_config}",
 *     "collection" = "/admin/config/user-interface/shortcut",
 *   },
 *   config_export = {
 *     "id",
 *     "label",
 *     "config_key",
 *     "config_value",
 *   }
 * )
 */
class ModalConfig extends ConfigEntityBundleBase implements ConfigEntityInterface {

  /**
   * The machine name for the configuration entity.
   *
   * @var string
   */
  protected $id;

  /**
   * The human-readable name of the configuration entity.
   *
   * @var string
   */
  protected $label;

}
