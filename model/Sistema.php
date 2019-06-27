<?php

namespace vendor\dmsylvio\actionlog\model;

use Yii;

/**
 * This is the model class for table "sistema".
 *
 * @property int $id
 * @property string $nome
 * @property string $descricao
 * @property string $url
 *
 * @property Actions[] $actions
 * @property Logs[] $logs
 * @property Menu[] $menus
 * @property SistemaUserPerfil[] $sistemaUserPerfils
 * @property Solicitacao[] $solicitacaos
 */
class Sistema extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sistema';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'descricao'], 'required'],
            [['nome'], 'string', 'max' => 50],
            [['descricao', 'url'], 'string', 'max' => 255],
            [['nome'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nome' => Yii::t('app', 'Nome'),
            'descricao' => Yii::t('app', 'Descricao'),
            'url' => Yii::t('app', 'Url'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActions()
    {
        return $this->hasMany(Actions::className(), ['id_sistema' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLogs()
    {
        return $this->hasMany(Logs::className(), ['id_sistema' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenus()
    {
        return $this->hasMany(Menu::className(), ['id_sistema' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSistemaUserPerfils()
    {
        return $this->hasMany(SistemaUserPerfil::className(), ['id_sistema' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSolicitacaos()
    {
        return $this->hasMany(Solicitacao::className(), ['id_sistema' => 'id']);
    }
}
