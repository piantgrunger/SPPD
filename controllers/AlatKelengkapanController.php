<?php

namespace app\controllers;

use Yii;
use app\models\AlatKelengkapan;
use app\models\DetAlatKelengkapan;
use app\models\AlatKelengkapanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use app\models\Personil;

/**
 * AlatKelengkapanController implements the CRUD actions for AlatKelengkapan model.
 */
class AlatKelengkapanController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all AlatKelengkapan models.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AlatKelengkapanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIndexMapping()
    {
        $searchModel = new AlatKelengkapanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if ($searchModel->tahun == '') {
            $searchModel->tahun = date('Y');
        }

        return $this->render('index-mapping', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCopy()
    {
        Yii::$app->db->createCommand('delete from tb_m_alat_kelengkapan where tahun='.date('Y').' and id_alat_kelengkapan not in (select id_alat_kelengkapan from tb_mt_spt)'
        )->execute();
        $alatKelengkapan = AlatKelengkapan::find()->where(['tahun' => date('Y') - 1])->all();

        foreach ($alatKelengkapan as $data) {
            $new = new AlatKelengkapan();
            $new->alat_kelengkapan = $data->alat_kelengkapan;
            $new->tahun = $data->tahun + 1;
            $new->save();
            foreach ($data->detailAlatKelengkapan as $detail) {
                $newDetail = new DetAlatKelengkapan();
                $newDetail->id_alat_kelengkapan = $new->id_alat_kelengkapan;
                $newDetail->id_personil = $detail->id_personil;
                $newDetail->jenis = $detail->jenis;
                $newDetail->save();
            }
        }
        $this->redirect('index');
    }

    /**
     * Displays a single AlatKelengkapan model.
     *
     * @param int $id
     *
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new AlatKelengkapan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AlatKelengkapan();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_alat_kelengkapan]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing AlatKelengkapan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param int $id
     *
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_alat_kelengkapan]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionMapping($id)
    {
        $model = $this->findModel($id);
        if (count($model->detailAlatKelengkapan) === 0) {
            $list = [];
            $detail = new DetAlatKelengkapan();
            $detail->id_personil = 102;
            $detail->id_alat_kelengkapan = $model->id_alat_kelengkapan;
            $detail->jenis = 'Ketua DPRD';

            array_push($list, $detail);
            $detail = new DetAlatKelengkapan();
            $detail->id_personil = 109;
            $detail->jenis = 'Wakil Ketua DPRD';
            array_push($list, $detail);
            $detail = new DetAlatKelengkapan();
            $detail->id_personil = 116;
            $detail->jenis = 'Wakil Ketua DPRD';
            array_push($list, $detail);

            $model->detailAlatKelengkapan = $list;

            /*
            $model->detailAlatKelengkapan=$detail;
            $detail = new DetAlatKelengkapan();
            $detail->id_personil = 109;
            $detail->jenis = 'Wakil Ketua DPRD';
            $model->detailAlatKelengkapan = $detail;
            $detail = new DetAlatKelengkapan();
            $detail->id_personil =116;
            $detail->jenis = 'Wakil Ketua DPRD';
            $model->detailAlatKelengkapan = $detail;
            */
        }

        if ($model->load(Yii::$app->request->post())) {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $model->detailAlatKelengkapan = Yii::$app->request->post('DetAlatKelengkapan', []);
                //die(var_dump($model->detailAlatKelengkapan));
                if ($model->save()) {
                    $transaction->commit();

                    return $this->redirect(['index-mapping']);
                }
            } catch (\yii\db\IntegrityException $e) {
                $transaction->rollBack();
                Yii::$app->session->setFlash('error', 'Data Tidak Dapat Direvisi Karena Dipakai Modul Lain');
            } catch (\Exception $ecx) {
                $transaction->rollBack();
                throw $ecx;
            }
        } else {
            return $this->render('mapping', [
                'model' => $model,
        ]);
        }
    }

    /**
     * Deletes an existing AlatKelengkapan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param int $id
     *
     * @return mixed
     */
    public function actionDelete($id)
    {
        try {
            $this->findModel($id)->delete();
        } catch (\yii\db\IntegrityException  $e) {
            Yii::$app->session->setFlash('error', 'Data Tidak Dapat Dihapus Karena Dipakai Modul Lain');
        }

        return $this->redirect(['index']);
    }

    public function actionPersonil($id)
    {
        $model = Personil::findOne(['id_personil' => $id]);

        return Json::encode([
            'id_personil' => $model->id_personil,
            'nama_personil' => $model->nama_personil,
            'status_personil' => $model->status_personil,
            'nama_pangkat' => $model->nama_pangkat,
        ]);
    }

    /**
     * Finds the AlatKelengkapan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param int $id
     *
     * @return AlatKelengkapan the loaded model
     *
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AlatKelengkapan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
