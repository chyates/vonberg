<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ModelPrices Model
 *
 * @method \App\Model\Entity\ModelPrice get($primaryKey, $options = [])
 * @method \App\Model\Entity\ModelPrice newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ModelPrice[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ModelPrice|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ModelPrice patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ModelPrice[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ModelPrice findOrCreate($search, callable $callback = null, $options = [])
 */
class ModelPricesTable extends Table
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

        $this->setTable('model_prices');
        $this->setDisplayField('model_priceID');
        $this->setPrimaryKey('model_priceID');
        $this->addBehavior('Search.Search');
        $this->searchManager()
//            ->value('id')
            ->add('q', 'Search.Like', [
                'before' => true,
                'after' => true,
                'fieldMode' => 'OR',
                'comparison' => 'LIKE',
                'wildcardAny' => '*',
                'wildcardOne' => '?',
                'field' => ['model_text'],
            ])
            ->add('foo', 'Search.Callback', [
                'callback' => function ($query, $args, $filter) {
                    // Modify $query as required
                }]);

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
            ->integer('model_priceID')
            ->allowEmpty('model_priceID', 'create');

        $validator
            ->scalar('model_text')
            ->maxLength('model_text', 20)
            ->allowEmpty('model_text');

        $validator
            ->decimal('unit_price')
            ->allowEmpty('unit_price');

        return $validator;
    }
}
