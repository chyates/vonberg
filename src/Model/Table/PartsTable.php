<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Parts Model
 *
 * @method \App\Model\Entity\Part get($primaryKey, $options = [])
 * @method \App\Model\Entity\Part newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Part[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Part|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Part patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Part[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Part findOrCreate($search, callable $callback = null, $options = [])
 */
class PartsTable extends Table
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
        $this->belongsTo('Connections')->setForeignKey('connectionID');
        $this->belongsTo('Styles')->setForeignKey('styleID');
        $this->belongsTo('Types')->setForeignKey('typeID');
        $this->belongsTo('Series')->setForeignKey('seriesID');
        $this->belongsTo('Categories')->setForeignKey('categoryID');
        $this->hasMany('TextBlocks',['sort' =>'TextBlocks.order_num ASC'])->setForeignKey('partID');
        $this->hasOne('ModelTables',['contains' =>'ModelTableRows'])->setForeignKey('partID');
        $this->hasMany('Specifications', ['sort' =>'Specifications.order_num ASC'])->setForeignKey('partID');
        $this->setTable('parts');
        $this->setDisplayField('partID');
        $this->setPrimaryKey('partID');
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
                'field' => ['description', 'Series.name'],
            ])
            ->add('seriesID', 'Search.Callback', [
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
            ->integer('partID')
            ->allowEmpty('partID', 'create');

        $validator
            ->integer('categoryID')
            ->allowEmpty('categoryID');

        $validator
            ->integer('seriesID')
            ->allowEmpty('seriesID');

        $validator
            ->integer('styleID')
            ->allowEmpty('styleID');

        $validator
            ->integer('connectionID')
            ->allowEmpty('connectionID');

        $validator
            ->integer('typeID')
            ->allowEmpty('typeID');

        $validator
            ->allowEmpty('description');

        $validator
            ->dateTime('last_updated')
            ->allowEmpty('last_updated');

        return $validator;
    }
}
