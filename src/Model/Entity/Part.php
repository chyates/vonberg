<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Part Entity
 *
 * @property int $partID
 * @property int $categoryID
 * @property int $seriesID
 * @property int $styleID
 * @property int $connectionID
 * @property int $typeID
 * @property string $description
 * @property \Cake\I18n\FrozenTime $last_updated
 *
 * @property \App\Model\Entity\Connection $connection
 * @property \App\Model\Entity\Style $style
 * @property \App\Model\Entity\Type $type
 * @property \App\Model\Entity\Series $series
 * @property \App\Model\Entity\Category $category
 * @property \App\Model\Entity\TextBlock[] $text_blocks
 * @property \App\Model\Entity\ModelTable $model_table
 * @property \App\Model\Entity\Specification[] $specifications
 */
class Part extends Entity
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
        'categoryID' => true,
        'seriesID' => true,
        'styleID' => true,
        'connectionID' => true,
        'typeID' => true,
        'description' => true,
        'last_updated' => true,
        'connection' => true,
        'style' => true,
        'type' => true,
        'series' => true,
        'category' => true,
        'text_blocks' => true,
        'model_table' => true,
        'specifications' => true
    ];
}
