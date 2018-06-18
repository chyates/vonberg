<?php
namespace App\Model\Table;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TechnicalSpecs Model
 *
 * @method \App\Model\Entity\TechnicalSpec get($primaryKey, $options = [])
 * @method \App\Model\Entity\TechnicalSpec newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TechnicalSpec[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TechnicalSpec|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TechnicalSpec patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TechnicalSpec[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TechnicalSpec findOrCreate($search, callable $callback = null, $options = [])
 */
class TechnicalSpecsTable extends Table
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

        $this->table('technical_specs');
        $this->displayField('title');
        $this->primaryKey('techID');
        $this->addBehavior('Josegonzalez/Upload.Upload', [
            // You can configure as many upload fields as possible,
            // where the pattern is `field` => `config`
            //
            // Keep in mind that while this plugin does not have any limits in terms of
            // number of files uploaded per request, you should keep this down in order
            // to decrease the ability of your users to block other requests.
            'file' => []
        ]);
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
            ->integer('techID')
            ->allowEmpty('techID', 'create');

        $validator
            ->scalar('title')
            ->maxLength('title', 255)
            ->allowEmpty('title');

        return $validator;
    }
}
