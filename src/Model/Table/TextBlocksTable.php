<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TextBlocks Model
 *
 * @method \App\Model\Entity\TextBlock get($primaryKey, $options = [])
 * @method \App\Model\Entity\TextBlock newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TextBlock[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TextBlock|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TextBlock patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TextBlock[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TextBlock findOrCreate($search, callable $callback = null, $options = [])
 */
class TextBlocksTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('text_blocks');
        $this->setDisplayField('text_blockID');
        $this->setPrimaryKey('text_blockID');
        $this->hasMany('TextBlockBullets',['order' =>'TextBlockBullets.order desc'])->setForeignKey('text_blockID');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('text_blockID')
            ->allowEmpty('text_blockID', 'create');

        $validator
            ->integer('partID')
            ->allowEmpty('partID');

        $validator
            ->integer('order_num')
            ->allowEmpty('order_num');

        $validator
            ->scalar('header')
            ->maxLength('header', 100)
            ->allowEmpty('header');

        return $validator;
    }
}
