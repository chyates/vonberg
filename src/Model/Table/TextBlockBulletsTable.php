<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TextBlockBullets Model
 *
 * @method \App\Model\Entity\TextBlockBullet get($primaryKey, $options = [])
 * @method \App\Model\Entity\TextBlockBullet newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TextBlockBullet[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TextBlockBullet|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TextBlockBullet patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TextBlockBullet[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TextBlockBullet findOrCreate($search, callable $callback = null, $options = [])
 */
class TextBlockBulletsTable extends Table
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

        $this->setTable('text_block_bullets');
        $this->setDisplayField('text_block_bulletID');
        $this->setPrimaryKey('text_block_bulletID');

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
            ->integer('text_block_bulletID')
            ->allowEmpty('text_block_bulletID', 'create');

        $validator
            ->integer('text_blockID')
            ->allowEmpty('text_blockID');

        $validator
            ->scalar('bullet_text')
            ->maxLength('bullet_text', 200)
            ->allowEmpty('bullet_text');

        $validator
            ->integer('order_num')
            ->allowEmpty('order_num');

        return $validator;
    }
}
