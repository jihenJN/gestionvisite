<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TypeContacts Model
 *
 * @property \App\Model\Table\VisitesTable&\Cake\ORM\Association\HasMany $Visites
 *
 * @method \App\Model\Entity\TypeContact newEmptyEntity()
 * @method \App\Model\Entity\TypeContact newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\TypeContact[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TypeContact get($primaryKey, $options = [])
 * @method \App\Model\Entity\TypeContact findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\TypeContact patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TypeContact[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\TypeContact|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TypeContact saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TypeContact[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\TypeContact[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\TypeContact[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\TypeContact[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class TypeContactsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('type_contacts');
        $this->setDisplayField('libelle');
        $this->setPrimaryKey('id');

        $this->hasMany('Visites', [
            'foreignKey' => 'type_contact_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('libelle')
            ->maxLength('libelle', 50)
            ->requirePresence('libelle', 'create')
            ->notEmptyString('libelle');

        return $validator;
    }
}
