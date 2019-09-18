# fpdf
Yii2-FPDF, extensión fpdf para yii2, pdf

Install

composer  require --ignore-platform-reqs --prefer-dist sam0786/fpdf:dev-master

example 

use sam0786\fpdf\FPDF;

    public function actionTestpdf(){
      Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
      Yii::$app->response->headers->add('Content-Type', 'application/pdf');


      $pdf = new FPDF();
      $pdf->AliasNbPages();
      $pdf->AddPage();
      $pdf->SetFont('Arial', 'B', 15);
      $pdf->Cell(40, 10, 'PDF');

      $pdf->Ln(15);
      $pdf->SetFont('Arial', '', 12);
      $pdf->WriteHTML('<ul> <li>color: hex color code</li> <li>face: available fonts are: arial, times, courier, helvetica, symbol</li> </ul>');
      $pdf->Ln(20);

      $pdf->SetFont('Arial', '', 10);
      $pdf->SetWidths(array(30,50,30,40));
      $pdf->Row(array("Titulo 1", "Titulo 2", "Titulo 3", "Titulo 4"));		
      $text = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean molestie leo id turpis mollis cursus. Etiam vitae mauris eget ligula pretium viverra eget nec est';
      $pdf->Row(array($text, $text, $text, $text));



      $pdf->Output();	
    }
