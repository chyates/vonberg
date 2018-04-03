<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Dealer Entity
 *
 * @property int $id
 * @property string $name
 * @property string $address
 * @property string $address1
 * @property string $address2
 * @property string $city
 * @property string $state
 * @property string $zip
 * @property string $country
 * @property string $telephone
 * @property string $fax
 * @property float $lat
 * @property float $lng
 */
class Dealer extends Entity
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
        'name' => true,
        'address' => true,
        'address1' => true,
        'address2' => true,
        'city' => true,
        'state' => true,
        'zip' => true,
        'country' => true,
        'telephone' => true,
        'fax' => true,
        'lat' => true,
        'lng' => true
    ];
}
