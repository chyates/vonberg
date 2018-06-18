<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Dealers Model
 *
 * @method \App\Model\Entity\Dealer get($primaryKey, $options = [])
 * @method \App\Model\Entity\Dealer newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Dealer[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Dealer|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Dealer patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Dealer[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Dealer findOrCreate($search, callable $callback = null, $options = [])
 */
class DealersTable extends Table
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

$options = array(
	// Refer to php.net fgetcsv for more information
	'length' => 0,
	'delimiter' => ',',
	'enclosure' => '"',
	'escape' => '\\',
	// Generates a Model.field headings row from the csv file
	'headers' => true,
);

        $this->setTable('dealers');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');
	$this->addBehavior('Geo.Geocoder', [ 'apiKey' => 'AIzaSyC5Z7f-hct4XitWSMJqz-s7Kv5YihiVp6o']);
	$this->addBehavior('CakePHPCSV.Csv', $options);
	$this->addBehavior('Chris48s/GeoDistance.GeoDistance', [ 'latitudeColumn' => 'lat', 'longitudeColumn' => 'lng' ]);
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
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 60)
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->scalar('address')
            ->maxLength('address', 80)
            ->requirePresence('address', 'create')
            ->notEmpty('address');

        $validator
            ->scalar('address1')
            ->maxLength('address1', 20)
            ->requirePresence('address1', 'create')
            ->allowEmpty('address1');

        $validator
            ->scalar('address2')
            ->maxLength('address2', 20)
            ->requirePresence('address2', 'create')
            ->allowEmpty('address2');

        $validator
            ->scalar('city')
            ->maxLength('city', 20)
            ->requirePresence('city', 'create')
            ->notEmpty('city');

        $validator
            ->scalar('state')
            ->maxLength('state', 2)
            ->requirePresence('state', 'create')
            ->notEmpty('state');

        $validator
            ->scalar('zip')
            ->maxLength('zip', 80)
            ->requirePresence('zip', 'create')
            ->notEmpty('zip');

        $validator
            ->scalar('country')
            ->maxLength('country', 10)
            ->requirePresence('country', 'create')
            ->allowEmpty('country');

        $validator
            ->scalar('telephone')
            ->maxLength('telephone', 20)
            ->requirePresence('telephone', 'create')
            ->allowEmpty('telephone');

        $validator
            ->scalar('fax')
            ->maxLength('fax', 20)
            ->requirePresence('fax', 'create')
            ->allowEmpty('fax');

        $validator
            ->numeric('lat')
            ->requirePresence('lat', 'create')
            ->allowEmpty('lat');

        $validator
            ->numeric('lng')
            ->requirePresence('lng', 'create')
            ->allowEmpty('lng');

        return $validator;
    }

}
