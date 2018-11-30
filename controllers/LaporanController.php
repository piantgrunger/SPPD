<?php

namespace app\controllers;

use Yii;
use app\models\SuratPerintahTugas;
use app\models\SPPDSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\AlatKelengkapan;
use kartik\mpdf\Pdf;

/**
 * SuratPerintahTugasController implements the CRUD actions for SuratPerintahTugas model.
 */
class LaporanController extends Controller
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
        $searchModel = new SPPDSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, 1);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCetakRekap($tgl_awal, $tgl_akhir)
    {
        $model = SuratPerintahTugas::find()->where(['between', 'tgl_awal', $tgl_awal, $tgl_akhir])->all();
        $content = $this->renderPartial('rekap', [
            'model' => $model,
            'tanggal1' => $tgl_awal,
        ]);
        $pdf = new Pdf([
   // set to use core fonts only
            'mode' => Pdf::MODE_UTF8,
   // A4 paper format
            'format' => Pdf::FORMAT_LEGAL,
   // portrait orientation
            'orientation' => Pdf::ORIENT_LANDSCAPE,
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

    public function actionCetakKartu($tgl_awal, $tgl_akhir, $alat_kelengkapan)
    {
        $model = SuratPerintahTugas::find()->where(['between', 'tgl_awal', $tgl_awal, $tgl_akhir])
        ->andWhere("id_alat_kelengkapan=$alat_kelengkapan")->all();
        $data = AlatKelengkapan::find()->where(['id_alat_kelengkapan' => $alat_kelengkapan])->one();
        $content = $this->renderPartial('kartu', [
            'model' => $model,
            'tanggal1' => $tgl_awal,
            'alat_kelengkapan' => $data->alat_kelengkapan,
        ]);
        $pdf = new Pdf([
   // set to use core fonts only
            'mode' => Pdf::MODE_UTF8,
   // A4 paper format
            'format' => Pdf::FORMAT_LEGAL,
   // portrait orientation
            'orientation' => Pdf::ORIENT_LANDSCAPE,
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
