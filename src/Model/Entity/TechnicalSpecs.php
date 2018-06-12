<?php
/**
 * Created by PhpStorm.
 * User: darren
 * Date: 6/12/18
 * Time: 12:11 PM
 */

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TechnicalSpec Entity
 *
 * @property int $techID
 * @property int $resource
 * @property \Cake\I18n\FrozenTime $last_updated
 * @property string $title
 * @property string $file
 */
class TechnicalSpec extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'resource' => true,
        'last_updated' => true,
        'title' => true,
        'file' => true
    ];
}
