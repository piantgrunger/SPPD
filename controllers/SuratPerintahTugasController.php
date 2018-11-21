<?php

namespace app\controllers;

use Yii;
use app\models\SuratPerintahTugas;
use app\models\SuratPerintahTugasSearch;
use app\models\SPPDSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\DetAlatKelengkapan;
use yii\helpers\Json;
use kartik\mpdf\Pdf;
use app\models\DetSuratPerintahTugas;
use app\models\SubSuratPerintahTugas;
use app\models\Tarif;

/**
 * SuratPerintahTugasController implements the CRUD actions for SuratPerintahTugas model.
 */
class SuratPerintahTugasController extends Controller
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
     * Lists all SuratPerintahTugas models.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SuratPerintahTugasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIndexSppd()
    {
        $searchModel = new SPPDSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, 0);
        $searchModel1 = new SPPDSearch();
        $dataProvider1 = $searchModel->search(Yii::$app->request->queryParams, 1);

        return $this->render('index-sppd', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'searchModel1' => $searchModel1,
            'dataProvider1' => $dataProvider1,
        ]);
    }

    public function actionIndexKwitansi()
    {
        $searchModel = new SPPDSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, 1);

        return $this->render('index-kwitansi', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SuratPerintahTugas model.
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

    public function actionBiaya($id)
    {
        $model = DetSuratPerintahTugas::find()->where(['id_d_spt' => $id])->one();

        if (count($model->subDetPerintahTugas) === 0) {
            $dataBiaya = Tarif::find()->where(['id_pangkat' => $model->id_pangkat, 'tujuan' => $model->suratPerintahTugas->zona])->all();
            $list = [];
            foreach ($dataBiaya as $data) {
                $model1 = new SubSuratPerintahTugas();
                $model1->nama_biaya = $data->nama_biaya;
                $model1->anggaran = $data->biaya;

                $model1->id_d_spt = $model->id_d_spt;
                $model1->id_spt = $model->id_spt;
                $model1->realisasi = 0;

                array_push($list, $model1);
            }
            if (count($list) > 0) {
                $model->subDetPerintahTugas = $list;
            }
        }

        if ($model->load(Yii::$app->request->post())) {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $model->subDetPerintahTugas = Yii::$app->request->post('SubSuratPerintahTugas', []);

                if ($model->save()) {
                    $transaction->commit();

                    return $this->redirect(['realisasi',   'id' => $model->id_spt]);
                }
            } catch (\yii\db\IntegrityException $e) {
                $transaction->rollBack();
                Yii::$app->session->setFlash('error', 'Data Tidak Dapat Direvisi Karena Dipakai Modul Lain');
            } catch (\Exception $ecx) {
                $transaction->rollBack();
                throw $ecx;
            }
        } else {
            return $this->renderAjax('biaya', [
            'model' => $model,
        ]);
        }
    }

    public function actionRealisasi($id)
    {
        $header = $this->findModel($id);
        foreach ($header->detailSuratPerintahTugas as $model) {
            if (count($model->subDetPerintahTugas) === 0) {
                $dataBiaya = Tarif::find()->where(['id_pangkat' => $model->id_pangkat, 'tujuan' => $model->suratPerintahTugas->zona])->all();
                $list = [];
                foreach ($dataBiaya as $data) {
                    $model1 = new SubSuratPerintahTugas();
                    $model1->nama_biaya = $data->nama_biaya;
                    $model1->anggaran = $data->biaya;

                    $model1->id_d_spt = $model->id_d_spt;
                    $model1->id_spt = $model->id_spt;
                    $model1->realisasi = 0;

                    array_push($list, $model1);
                }
                if (count($list) > 0) {
                    $model->subDetPerintahTugas = $list;
                }
                $model->save(false);
            }
        }

        return $this->render('realisasi', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new SuratPerintahTugas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return mixed
     */
    public function actionPrintRealisasi($id)
    {
        $content = $this->renderPartial('printrealisasi', [
            'model' => $this->findModel($id),
            'mode' => 1,
        ]);
        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
   // set to use core fonts only
            'mode' => Pdf::MODE_UTF8,
   // A4 paper format
            'format' => Pdf::FORMAT_LEGAL,
   // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT,
   // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
   // your html content input
            'content' => $content,
   // format content from your own css file if needed or use the
   // enhanced bootstrap css built by Krajee for mPDF formatting
            'cssFile' => '@app/web/css/print.css',
        'defaultFont' => 'Arial',
   // any css to be embedded if required
            'cssInline' => '.kv-heading-1{font-size:18px}',
    // set mPDF properties on the fly
            'options' => ['title' => 'Cetak SPT '],
    // call mPDF methods on the fly
        ]);

        return $pdf->render();
    }

    public function actionPrintKwitansi($id)
    {
        $content = $this->renderPartial('printkwitansi', [
            'model' => $this->findModel($id),
            'mode' => 1,
        ]);
        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
   // set to use core fonts only
            'mode' => Pdf::MODE_UTF8,
   // A4 paper format
            'format' => Pdf::FORMAT_LEGAL,
   // portrait orientatiopn
            'orientation' => Pdf::ORIENT_PORTRAIT,
   // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
   // your html content input
            'content' => $content,
   // format content from your own css file if needed or use the
   // enhanced bootstrap css built by Krajee for mPDF formatting
            'cssFile' => '@app/web/css/print.css',
        'defaultFont' => 'Arial',
   // any css to be embedded if required
            'cssInline' => '.kv-heading-1{font-size:18px}',
    // set mPDF properties on the fly
            'options' => ['title' => 'Cetak SPT '],
    // call mPDF methods on the fly
        ]);

        return $pdf->render();
    }

    public function actionPrint1($id)
    {
        $content = $this->renderPartial('printspt', [
            'model' => $this->findModel($id),
            'mode' => 1,
            'titel' => 'KETUA DEWAN PERWAKILAN RAKYAT DAERAH',
        ]);
        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
   // set to use core fonts only
            'mode' => Pdf::MODE_UTF8,
   // A4 paper format
            'format' => Pdf::FORMAT_LEGAL,
   // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT,
   // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
   // your html content input
            'content' => $content,
   // format content from your own css file if needed or use the
   // enhanced bootstrap css built by Krajee for mPDF formatting
            'cssFile' => '@app/web/css/print.css',
        'defaultFont' => 'Arial',
   // any css to be embedded if required
            'cssInline' => '.kv-heading-1{font-size:18px}',
    // set mPDF properties on the fly
            'options' => ['title' => 'Cetak SPT '],
    // call mPDF methods on the fly
        ]);

        return $pdf->render();
    }

    public function actionPrintSppd1($id)
    {
        $content = $this->renderPartial('printsppd', [
            'model' => $this->findModel($id),
            'mode' => 1,
            'titel' => 'KETUA DEWAN PERWAKILAN RAKYAT DAERAH',
        ]);
        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
   // set to use core fonts only
            'mode' => Pdf::MODE_UTF8,
   // A4 paper format
            'format' => Pdf::FORMAT_LEGAL,
   // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT,
   // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
   // your html content input
            'content' => $content,
            'defaultFont' => 'Arial',
   // format content from your own css file if needed or use the
   // enhanced bootstrap css built by Krajee for mPDF formatting
            'cssFile' => '@app/web/css/print.css',
   // any css to be embedded if required
            'cssInline' => '.kv-heading-1{font-size:18px}',
    // set mPDF properties on the fly
            'options' => ['title' => 'Cetak SPPD '],
    // call mPDF methods on the fly
        ]);

        return $pdf->render();
    }

    public function actionPrintSppd2($id)
    {
        $content = $this->renderPartial('printsppd', [
            'model' => $this->findModel($id),
            'mode' => 2,
            'titel' => 'SEKRETARIS DEWAN PERWAKILAN RAKYAT DAERAH',
        ]);
        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
   // set to use core fonts only
            'mode' => Pdf::MODE_UTF8,
   // A4 paper format
            'format' => Pdf::FORMAT_LEGAL,
   // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT,
   // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
   // your html content input
            'content' => $content,
   // format content from your own css file if needed or use the
   // enhanced bootstrap css built by Krajee for mPDF formatting
            'cssFile' => '@app/web/css/print.css',
            'defaultFont' => 'Arial',
   // any css to be embedded if required
            'cssInline' => '.kv-heading-1{font-size:18px}',
    // set mPDF properties on the fly
            'options' => ['title' => 'Cetak SPPD '],
    // call mPDF methods on the fly
        ]);

        return $pdf->render();
    }

    public function actionPrintSppd3($id)
    {
        $content = $this->renderPartial('printsppd', [
            'model' => $this->findModel($id),
            'mode' => 3,
            'titel' => 'SEKRETARIS DAERAH &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',
        ]);
        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
   // set to use core fonts only
            'mode' => Pdf::MODE_UTF8,
   // A4 paper format
            'format' => Pdf::FORMAT_LEGAL,
   // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT,
   // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
   // your html content input
            'content' => $content,
   // format content from your own css file if needed or use the
   // enhanced bootstrap css built by Krajee for mPDF formatting
           'cssFile' => '@app/web/css/print.css',
         'defaultFont' => 'Arial',
   // any css to be embedded if required
            'cssInline' => '.kv-heading-1{font-size:18px}',
    // set mPDF properties on the fly
            'options' => ['title' => 'Cetak SPPD '],
    // call mPDF methods on the fly
        ]);

        return $pdf->render();
    }

    public function actionPrint2($id)
    {
        $content = $this->renderPartial('printspt', [
            'model' => $this->findModel($id),
            'mode' => 2,
            'titel' => 'SEKRETARIS DEWAN PERWAKILAN RAKYAT DAERAH',
        ]);
        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
   // set to use core fonts only
            'mode' => Pdf::MODE_UTF8,
   // A4 paper format
            'format' => Pdf::FORMAT_LEGAL,
   // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT,
   // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
   // your html content input
            'content' => $content,
   // format content from your own css file if needed or use the
   // enhanced bootstrap css built by Krajee for mPDF formatting
            'cssFile' => '@app/web/css/print.css',
         'defaultFont' => 'Arial',
   // any css to be embedded if required
            'cssInline' => '.kv-heading-1{font-size:18px}',
    // set mPDF properties on the fly
            'options' => ['title' => 'Cetak SPT '],
    // call mPDF methods on the fly
        ]);

        return $pdf->render();
    }

    public function actionPrint3($id)
    {
        $content = $this->renderPartial('printspt', [
            'model' => $this->findModel($id),
            'mode' => 3,
            'titel' => 'SEKRETARIS DAERAH &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',
        ]);
        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
   // set to use core fonts only
            'mode' => Pdf::MODE_UTF8,
   // A4 paper format
            'format' => Pdf::FORMAT_LEGAL,
   // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT,
   // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
   // your html content input
            'content' => $content,
            'defaultFont' => 'Arial',
   // format content from your own css file if needed or use the
   // enhanced bootstrap css built by Krajee for mPDF formatting
          'cssFile' => '@app/web/css/print.css',
   // any css to be embedded if required
            'cssInline' => '.kv-heading-1{font-size:18px}',
    // set mPDF properties on the fly
            'options' => ['title' => 'Cetak SPT '],
    // call mPDF methods on the fly
        ]);

        return $pdf->render();
    }

    public function actionCreate()
    {
        $model = new SuratPerintahTugas();

        if ($model->load(Yii::$app->request->post())) {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $model->detailSuratPerintahTugas = Yii::$app->request->post('DetSuratPerintahTugas', []);
                //die(var_dump($model->detailAlatKelengkapan));
                if ($model->save()) {
                    $transaction->commit();

                    return $this->redirect(['index']);
                }
            } catch (\yii\db\IntegrityException $e) {
                $transaction->rollBack();
                Yii::$app->session->setFlash('error', 'Data Tidak Dapat Direvisi Karena Dipakai Modul Lain');
            } catch (\Exception $ecx) {
                $transaction->rollBack();
                throw $ecx;
            }

            return $this->render('create', [
                'model' => $model,
            ]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing SuratPerintahTugas model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param int $id
     *
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $model->detailSuratPerintahTugas = Yii::$app->request->post('DetSuratPerintahTugas', []);
                //die(var_dump($model->detailAlatKelengkapan));
                if ($model->save()) {
                    $transaction->commit();

                    return $this->redirect(['index']);
                }
            } catch (\yii\db\IntegrityException $e) {
                $transaction->rollBack();
                Yii::$app->session->setFlash('error', 'Data Tidak Dapat Direvisi Karena Dipakai Modul Lain');
            } catch (\Exception $ecx) {
                $transaction->rollBack();
                throw $ecx;
            }

            return $this->render('update', [
                'model' => $model,
            ]);
        } else {
            if ($model->id_kegiatan === null) {
                return $this->render('update', [
                'model' => $model,
            ]);
            } else {
                Yii::$app->session->setFlash('error', 'Data Tidak Dapat Dikoreksi Karena Sudah Dibuat SPPD ');

                return $this->redirect(['index']);
            }
        }
    }

    public function actionSppd($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                //die(var_dump($model->detailAlatKelengkapan));
                if ($model->save()) {
                    $transaction->commit();

                    return $this->redirect(['index-sppd']);
                }
            } catch (\yii\db\IntegrityException $e) {
                $transaction->rollBack();
                Yii::$app->session->setFlash('error', 'Data Tidak Dapat Direvisi Karena Dipakai Modul Lain');
            } catch (\Exception $ecx) {
                $transaction->rollBack();
                throw $ecx;
            }

            return $this->render('sppd', [
                'model' => $model,
            ]);
        } else {
            return $this->render('sppd', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing SuratPerintahTugas model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param int $id
     *
     * @return mixed
     */
    public function actionDelete($id)
    {
        try {
            $model = $this->findModel($id);
            if ($model->id_kegiatan === null) {
                $model->delete();
            } else {
                Yii::$app->session->setFlash('error', 'Data Tidak Dapat Dihapus Karena Sudah Dibuat SPPD ');
            }
        } catch (\yii\db\IntegrityException  $e) {
            Yii::$app->session->setFlash('error', 'Data Tidak Dapat Dihapus Karena Dipakai Modul Lain');
        }

        return $this->redirect(['index']);
    }

    public function actionAlatKelengkapan($id, $jenis)
    {
        return  Json::encode(DetAlatKelengkapan::find()
        ->select('tb_d_alat_kelengkapan.*,tb_m_personil.nama_personil,nama_pangkat,status_personil ')
        ->leftJoin('tb_m_personil', 'tb_m_personil.id_personil = tb_d_alat_kelengkapan.id_personil')
            ->leftJoin('tb_m_pangkat', 'tb_m_personil.id_pangkat = tb_m_pangkat.id_pangkat')

        ->where("id_alat_kelengkapan=$id")
        ->andWhere("status_personil='$jenis'")

          ->orderBy([new \yii\db\Expression('FIELD (jenis, "Ketua DPRD", "Wakil Ketua DPRD", "Ketua","Wakil Ketua","Sekretaris","Anggota","Staff")')])
        ->asArray()->all());
    }

    /**
     * Finds the SuratPerintahTugas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param int $id
     *
     * @return SuratPerintahTugas the loaded model
     *
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SuratPerintahTugas::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
