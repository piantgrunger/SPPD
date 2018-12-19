<?php

namespace app\controllers;

use Yii;
use app\models\Kegiatan;
use app\models\SuratPerintahTugas;
use app\models\SPPDSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\AlatKelengkapan;
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
        $searchModel = new DynamicModel(["tahun", "bulan"]);
        $searchModel->addRule(["tahun","bulan"], "required")
                      ->addRule(["tahun","bulan"], "integer")
             //         ->validate()
                      ;
        $searchModel->bulan = date("m");
        $searchModel->tahun = date("Y");

        $searchModel2 = new DynamicModel(["tahun", "bulan","kegiatan"]);
        $searchModel2->addRule(["tahun", "bulan","kegiatan"], "required")
            ->addRule(["tahun", "bulan"], "integer");
        //         ->validate();
        $searchModel2->bulan = date("m");
        $searchModel2->tahun = date("Y");

        return $this->render('index', [
            'searchModel' => $searchModel,
            'searchModel2' => $searchModel2,
        ]);
    }

    public function actionCetakRekap()
    {
        //s   die(var_dump(Yii::$app->request->post()));

        $post = Yii::$app->request->post();
        $bulan = $post["DynamicModel"]["bulan"];
        $tahun = $post["DynamicModel"]["tahun"];

        $model = SuratPerintahTugas::find()->where(new \yii\db\Expression("month(tgl_awal) = $bulan and year(tgl_awal) = $tahun "))->all();
        $tgl_awal =$tahun .'-'.$bulan.'-1';
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
        $bulan = $post["DynamicModel"]["bulan"];
        $tahun = $post["DynamicModel"]["tahun"];
        $id_kegiatan = $post["DynamicModel"]["kegiatan"];


        $model = SuratPerintahTugas::find()->where(new \yii\db\Expression("month(tgl_awal) = $bulan and year(tgl_awal) = $tahun  and id_kegiatan =$id_kegiatan "))->all();
        $tgl_awal = $tahun . '-' . $bulan . '-1';
        $kegiatan = Kegiatan::findOne($id_kegiatan);
        $content = $this->renderPartial('rekap-kegiatan', [
            'model' => $model,
            'tanggal1' => $tgl_awal,
            'nama_kegiatan' => $kegiatan->nama_kegiatan
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

    public function actionCetakKartu($tgl_awal, $tgl_akhir)
    {
        $model = SuratPerintahTugas::find()->where(['between', 'tgl_awal', $tgl_awal, $tgl_akhir])
      ;
        $data = SuratPerintahTugas::find()->select('tb_mt_spt.id_alat_kelengkapan,alat_kelengkapan as nama_alat_kelengkapan')->distinct()->
        innerJoin('tb_m_alat_kelengkapan', 'tb_m_alat_kelengkapan.id_alat_kelengkapan = tb_mt_spt.id_alat_kelengkapan')

        ->where(['between', 'tgl_awal', $tgl_awal, $tgl_akhir])
        ->orderBy('alat_kelengkapan')
        ->all();
        $content = $this->renderPartial('kartu', [
            'model' => $model,
            'tanggal1' => $tgl_awal,
            'list' => $data,
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
