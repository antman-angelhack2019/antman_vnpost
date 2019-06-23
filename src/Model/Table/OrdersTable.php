<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Orders Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\WarehousesTable|\Cake\ORM\Association\BelongsTo $Warehouses
 *
 * @method \App\Model\Entity\Order get($primaryKey, $options = [])
 * @method \App\Model\Entity\Order newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Order[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Order|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Order saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Order patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Order[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Order findOrCreate($search, callable $callback = null, $options = [])
 */
class OrdersTable extends Table
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

        $this->setTable('orders');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Admins', [
            'foreignKey' => 'user_id',
            'joinType' => 'LEFT'
        ]);
        $this->belongsTo('Warehouses', [
            'foreignKey' => 'warehouse_id',
            'joinType' => 'INNER'
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
            ->integer('id')
            ->allowEmptyString('id', 'create');

        $validator
            ->scalar('order_code')
            ->maxLength('order_code', 16)
            ->requirePresence('order_code', 'create')
            ->allowEmptyString('order_code', false);

        $validator
            ->scalar('from_name')
            ->maxLength('from_name', 255)
            ->requirePresence('from_name', 'create')
            ->allowEmptyString('from_name', false);

        $validator
            ->scalar('to_name')
            ->maxLength('to_name', 255)
            ->requirePresence('to_name', 'create')
            ->allowEmptyString('to_name', false);

        $validator
            ->scalar('from_address')
            ->maxLength('from_address', 255)
            ->requirePresence('from_address', 'create')
            ->allowEmptyString('from_address', false);

        $validator
            ->scalar('to_address')
            ->maxLength('to_address', 255)
            ->requirePresence('to_address', 'create')
            ->allowEmptyString('to_address', false);

        $validator
            ->scalar('from_tel')
            ->maxLength('from_tel', 64)
            ->requirePresence('from_tel', 'create')
            ->allowEmptyString('from_tel', false);

        $validator
            ->scalar('to_tel')
            ->maxLength('to_tel', 64)
            ->requirePresence('to_tel', 'create')
            ->allowEmptyString('to_tel', false);

        $validator
            ->boolean('product_type')
            ->allowEmptyString('product_type', false);

        $validator
            ->integer('status')
            ->allowEmptyString('status', false);

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        //$rules->add($rules->existsIn(['user_id'], 'Users'));
        //$rules->add($rules->existsIn(['warehouse_id'], 'Warehouses'));

        return $rules;
    }

    public function getById(int $id) {
        return $this->find()
            ->where([
                'id' => $id
            ])
            ->enableHydration(false)
            ->toArray();
    }

    public function getByQrCode(string $qr_code) {
        return $this->find()
            ->where([
                'qr_code' => $qr_code
            ])
            ->enableHydration(false)
            ->toArray();
    }

    public function getByIds(array $ids = []) {
        return $this->find()
            ->where([
                'id IN' => $ids
            ])
            ->toArray();
    }

    public function getList() {
        return $this->find()
            ->where([
                'status' => 1
            ])
            ->enableHydration(false)
            ->toArray();
    }

}
