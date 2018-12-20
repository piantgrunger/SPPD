<?php

namespace app\controllers;

use Yii;
use app\models\Kegiatan;
use app\models\SuratPerintahTugas;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use kartik\mpdf\Pdf;
use yii\base\DynamicModel;

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
        $searchModel = new DynamicModel(['tahun', 'bulan']);
        $searchModel->addRule(['tahun', 'bulan'], 'required')
                      ->addRule(['tahun', 'bulan'], 'integer')
             //         ->validate()
                      ;
        $searchModel->bulan = date('m');
        $searchModel->tahun = date('Y');

        $searchModel2 = new DynamicModel(['tahun', 'bulan', 'kegiatan']);
        $searchModel2->addRule(['tahun', 'bulan', 'kegiatan'], 'required')
            ->addRule(['tahun', 'bulan'], 'integer');
        //         ->validate();
        $searchModel2->bulan = date('m');
        $searchModel2->tahun = date('Y');

        $searchModel3 = new DynamicModel(['tahun',  'alat_kelengkapan']);
        $searchModel3->addRule(['tahun',  'alat_kelengkapan'], 'required')
            ->addRule(['tahun'], 'integer');
        //         ->validate();

        $searchModel3->tahun = date('Y');

        $searchModel4 = new DynamicModel(['tahun',  'nama_kegiatan']);
        $searchModel4->addRule(['tahun',  'nama_kegiatan'], 'required')
            ->addRule(['tahun'], 'integer');
        //         ->validate();

        $searchModel4->tahun = date('Y');

        return $this->render('index', [
            'searchModel' => $searchModel,
            'searchModel2' => $searchModel2,
            'searchModel3' => $searchModel3,
            'searchModel4' => $searchModel4,
        ]);
    }

    public function actionCetakRekap()
    {
        //s   die(var_dump(Yii::$app->request->post()));

        $post = Yii::$app->request->post();
        $bulan = $post['DynamicModel']['bulan'];
        $tahun = $post['DynamicModel']['tahun'];

        $model = SuratPerintahTugas::find()->where(new \yii\db\Expression("month(tgl_awal) = $bulan and year(tgl_awal) = $tahun "))->all();
        $tgl_awal = $tahun.'-'.$bulan.'-1';
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

    public function actionCetakRekapKegiatan()
    {
        //s   die(var_dump(Yii::$app->request->post()));

        $post = Yii::$app->request->post();
        $bulan = $post['DynamicModel']['bulan'];
        $tahun = $post['DynamicModel']['tahun'];
        $id_kegiatan = $post['DynamicModel']['kegiatan'];

        $model = SuratPerintahTugas::find()->where(new \yii\db\Expression("month(tgl_awal) = $bulan and year(tgl_awal) = $tahun  and id_kegiatan =$id_kegiatan "))->all();
        $tgl_awal = $tahun.'-'.$bulan.'-1';
        $kegiatan = Kegiatan::findOne($id_kegiatan);
        $content = $this->renderPartial('rekap-kegiatan', [
            'model' => $model,
            'tanggal1' => $tgl_awal,
            'nama_kegiatan' => $kegiatan->nama_kegiatan,
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

    public function actionCetakRekapKegiatanTahunan()
    {
        //s   die(var_dump(Yii::$app->request->post()));

        $post = Yii::$app->request->post();
        $tahun = $post['DynamicModel']['tahun'];
        $id_kegiatan = $post['DynamicModel']['nama_kegiatan'];

        $model = SuratPerintahTugas::find()->where(new \yii\db\Expression(" year(tgl_awal) = $tahun  and id_kegiatan =$id_kegiatan "))->orderBy('tgl_awal')->all();
        $tgl_awal = $tahun.'-1-1';
        $kegiatan = Kegiatan::findOne($id_kegiatan);
        $content = $this->renderPartial('rekap-kegiatan-tahunan', [
            'model' => $model,
            'tanggal1' => $tgl_awal,
            'nama_kegiatan' => $kegiatan->nama_kegiatan,
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

    public function actionCetakRekapAlatKelengkapan()
    {
        $post = Yii::$app->request->post();
        $tahun = $post['DynamicModel']['tahun'];
        $alatKelengkapan = $post['DynamicModel']['alat_kelengkapan'];
        $model = SuratPerintahTugas::find()->where(new \yii\db\Expression("year(tgl_awal) = $tahun  and id_alat_kelengkapan='$alatKelengkapan'"));

        $content = $this->renderPartial('kartu', [
            'model' => $model,
            'tahun' => $tahun,
            'id_alat_kelengkapan' => $alatKelengkapan,
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
