<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Visites Model
 *
 * @property \App\Model\Table\ClientsTable&\Cake\ORM\Association\BelongsTo $Clients
 * @property \App\Model\Table\VisiteursTable&\Cake\ORM\Association\BelongsTo $Visiteurs
 * @property \App\Model\Table\TypeContactsTable&\Cake\ORM\Association\BelongsTo $TypeContacts
 *
 * @method \App\Model\Entity\Visite newEmptyEntity()
 * @method \App\Model\Entity\Visite newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Visite[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Visite get($primaryKey, $options = [])
 * @method \App\Model\Entity\Visite findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Visite patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Visite[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Visite|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Visite saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Visite[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Visite[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Visite[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Visite[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class VisitesTable extends Table
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

        $this->setTable('visites');
        $this->setDisplayField('commentaire');
        $this->setPrimaryKey('id');

        $this->belongsTo('Clients', [
            'foreignKey' => 'client_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Visiteurs', [
            'foreignKey' => 'visiteur_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('TypeContacts', [
            'foreignKey' => 'type_contact_id',
            'joinType' => 'INNER',
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
            ->integer('numero')
            ->requirePresence('numero', 'create')
            ->notEmptyString('numero');

        $validator
            ->scalar('commentaire')
            ->maxLength('commentaire', 50)
            ->requirePresence('commentaire', 'create')
            ->notEmptyString('commentaire');

        $validator
            ->scalar('lieu')
            ->maxLength('lieu', 50)
            ->requirePresence('lieu', 'create')
            ->notEmptyString('lieu');

        $validator
            ->date('date_demande')
            ->allowEmptyDate('date_demande');

        $validator
            ->date('date_prevu')
            ->allowEmptyDate('date_prevu');

        $validator
            ->date('date_visite')
            ->allowEmptyDate('date_visite');

        $validator
            ->scalar('localisation')
            ->maxLength('localisation', 100)
            ->requirePresence('localisation', 'create')
            ->notEmptyString('localisation');

        $validator
            ->boolean('effectue')
            ->requirePresence('effectue', 'create')
            ->notEmptyString('effectue');

        $validator
            ->integer('client_id')
            ->notEmptyString('client_id');

        $validator
            ->integer('visiteur_id')
            ->notEmptyString('visiteur_id');

        $validator
            ->integer('type_contact_id')
            ->notEmptyString('type_contact_id');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn('client_id', 'Clients'), ['errorField' => 'client_id']);
        $rules->add($rules->existsIn('visiteur_id', 'Visiteurs'), ['errorField' => 'visiteur_id']);
        $rules->add($rules->existsIn('type_contact_id', 'TypeContacts'), ['errorField' => 'type_contact_id']);

        return $rules;
    }
}
