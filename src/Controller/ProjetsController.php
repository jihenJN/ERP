<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Routing\Router;

use App\Model\Entity\Piecereglement;
use Cake\Datasource\ConnectionManager;
use Cake\I18n\Time;
use Cake\I18n\FrozenTime;
use Cake\Database\Expression\QueryExpression;
use Cake\Controller\Component\RequestHandlerComponent;

// require_once(ROOT . '/vendor/PHPMailer/PHPMailer/src/PHPMailer.php');
// require_once(ROOT . '/vendor/PHPMailer/PHPMailer/src/SMTP.php');
// require_once(ROOT . '/vendor/PHPMailer/PHPMailer/src/Exception.php');
// require_once(ROOT . '/vendor/dompdf/autoload.inc.php');

use Dompdf\Dompdf;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require(ROOT . '/vendor/autoload.php');

error_reporting(E_ERROR | E_PARSE);

/**
 * Projets Controller
 *
 * @property \App\Model\Table\ProjetsTable $Projets
 * @method \App\Model\Entity\Projet[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProjetsController extends AppController
{
    public function generatepdf($id)
    {
        //  Configure::write('debug', true);
        $this->loadModel('Commandeclients');
        $this->loadModel('Lignecommandeclients');
        $this->loadModel('Depots');
        $this->loadModel('Pointdeventes');
        $this->loadModel('Clients');
        $commandeclient = $this->Commandeclients->get($id, [
            'contain' => ['Conditionreglements', 'Delailivraisons', 'Methodeexpeditions', 'Lignecommandeclients', 'Clients', 'Projets', 'Incoterms', 'Devises'],
        ]);
        debug($commandeclient);
        $clients = $this->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $pointdeventes = $this->Pointdeventes->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $depots = $this->Depots->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        // $lignecommandeclients = $this->Lignecommandeclients->find('all')->where(["Lignecommandeclients.commandeclient_id=" . $id . " "])->ToArray();
        $connection = ConnectionManager::get('default');
        // $lignecommandeclients = $connection->execute("SELECT lc.* FROM lignecommandeclients lc WHERE commandeclient_id='".$id."' INNER JOIN (SELECT article_id, MAX(prixht) AS max_price FROM lignecommandeclients WHERE commandeclient_id='".$id."' GROUP BY article_id) AS max_prices ON lc.article_id = max_prices.article_id AND lc.prixht = max_prices.max_price;")->fetchAll('assoc');
        // $lignecommandeclients = $connection->execute("SELECT lc.* FROM lignecommandeclients lc INNER JOIN ( SELECT article_id, MAX(prixht) AS max_price FROM lignecommandeclients WHERE commandeclient_id='" . $id . "' GROUP BY article_id) AS max_prices ON lc.article_id = max_prices.article_id AND lc.prixht = max_prices.max_price WHERE lc.commandeclient_id='" . $id . "'")->fetchAll('assoc');
        // $lignecommandeclient2s = $connection->execute("SELECT lc.* FROM lignecommandeclients lc INNER JOIN ( SELECT article_id, MAX(prixht) AS max_price FROM lignecommandeclients WHERE lignecommandeclients.type=2 and commandeclient_id='" . $id . "' GROUP BY article_id) AS max_prices ON lc.article_id = max_prices.article_id AND lc.prixht = max_prices.max_price WHERE lc.commandeclient_id='" . $id . "'")->fetchAll('assoc');

        $lignecommandeclients = $this->Commandeclients->Lignecommandeclients->find('all')->where(["Lignecommandeclients.commandeclient_id=" . $id]); //->ToArray();
        $lignecommandeclient2s = $this->Commandeclients->Lignecommandeclients->find('all')->where(["Lignecommandeclients.commandeclient_id=" . $id, "Lignecommandeclients.type=2"]); //->ToArray();

        // debug($lignecommandeclients);
        $lignecommandeclient2sdes = $this->Commandeclients->Lignecommandeclients->find('all')->where(["Lignecommandeclients.commandeclient_id=" . $id, "Lignecommandeclients.type=2"])->first();
        $this->loadModel('Articles');
        $articles = $this->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation']);
        $societes = $this->fetchTable('Societes')->find('all')->first();
        $compbanq = '';

        if ($commandeclient->projet_id != null) {
            $projeet = $this->fetchTable('Projets')->find('all', [
                'contain' => ['Devises'],
            ])->where(['Projets.id=' . $commandeclient->projet_id])->first();
            debug($commandeclient);
            if ($projeet['banque_id'] && $commandeclient['devis_id']) {
                $comptebanq = $this->fetchTable('ComptesBank')->find('all')->where(['ComptesBank.banque_id=' . $projeet['banque_id'], 'ComptesBank.devise_id=' . $commandeclient['devis_id']])->first();
                // $banquee = $connection->execute("SELECT compte FROM comptesBank WHERE id = '" . $projet[0]['comptesBank_id'] . "'")->fetchAll('assoc');
                $compbanq = $comptebanq['compte'];
            }
        }

        $this->set(compact('lignecommandeclient2sdes', 'lignecommandeclient2s', 'projeet', 'lignecommandeclients', 'compbanq', 'societes', 'articles', 'commandeclient', 'clients', 'pointdeventes', 'depots'));
    }

    public function generatePdf1()
    {
        Configure::write('debug', true);
        // Inclure manuellement la bibliothèque TCPDF
        require_once(ROOT . DS . 'vendor' . DS . 'tcpdf' . DS . 'tcpdf.php');

        // Créer une nouvelle instance TCPDF
        $pdf = new \TCPDF();

        // Définir les propriétés de base du document
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('CakePHP 4 Application');
        $pdf->SetTitle('Exemple de document PDF');
        $pdf->SetSubject('Utilisation de TCPDF dans CakePHP');
        $pdf->SetKeywords('CakePHP, TCPDF, PDF');

        // Ajouter une page
        $pdf->AddPage();

        // Définir le contenu HTML pour le PDF
        // Charger le contenu HTML depuis le template imprimeview.php
        $html = $this->renderView('Projets/imprimeview');

        // Écrire le contenu HTML dans le PDF
        $pdf->writeHTML($html, true, false, true, false, '');

        // Sortir le PDF pour le visualiser dans le navigateur
        $pdf->Output('example.pdf', 'I'); // 'I' pour afficher dans le navigateur, 'D' pour forcer le téléchargement
    }
    protected function renderView($view)
    {
        // Rendre la vue
        $this->viewBuilder()->setLayout(false); // Désactiver le layout
        $this->response->withCharset('UTF-8'); // Assurer que la réponse est UTF-8
        return $this->render($view);
    }
    public function downloadfactclient($id)
    {
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

        $domainName = $_SERVER['HTTP_HOST'];
        $requestUri = $_SERVER['REQUEST_URI'];
        $segments = explode('/', trim($requestUri, '/')); // Découpe l'URL en segments

        $baseSegment = isset($segments[0]) ? '/' . $segments[0] : '/';

        $wr = $protocol . $domainName . $baseSegment;
        $this->loadModel('Commandeclients');
        $this->loadModel('Lignecommandeclients');
        $this->loadModel('Depots');
        $this->loadModel('Pointdeventes');
        $this->loadModel('Clients');
        $this->loadModel('Factureclients');
        // Récupérer les données nécessaires
        $commandeclient = $this->Factureclients->get($id, [
            'contain' => ['Adresselivraisonclients', 'Clients', 'Devises', 'Incoterms'],
        ]);
        //debug($commandeclient);die;
        $project_id = $commandeclient->projet_id;
        $this->loadModel('Personnels');
        $this->loadModel('Lignebonlivraisons');
        if ($commandeclient->bonlivraison_id) {
            $bonlivraison = $this->fetchTable('Bonlivraisons')->find('all', [
                'contain' => ['Commandes']
            ])->where(['Bonlivraisons.id = ' . $commandeclient->bonlivraison_id . '   ']);
        }
        $this->loadModel('Lignecommandeclients');
        //$lignecommandeclients = $this->Factureclients->Lignecommandeclients->find('all')->where(["Lignecommandeclients.commandeclient_id=" . $id . " "]);
        $this->loadModel('Articles');
        $lignecommandeclients = $this->Factureclients->Lignefactureclients->find('all', [
            'contain' => ['Articles']
        ])
            ->where(['factureclient_id' => $id/* , 'type' => 1 */]);
        $connection = ConnectionManager::get('default');

        $lignecommandeclient2s = $connection->execute("SELECT lc.* FROM lignefactureclients lc INNER JOIN ( SELECT article_id, MAX(prixht) AS max_price FROM lignefactureclients WHERE lignefactureclients.type=2 and factureclient_id='" . $id . "' GROUP BY article_id) AS max_prices ON lc.article_id = max_prices.article_id AND lc.prixht = max_prices.max_price WHERE lc.factureclient_id='" . $id . "'")->fetchAll('assoc');

        $societes = $this->fetchTable('Societes')->find('all')->first();
        $this->loadModel('Lignecommandeclients');
        //Configure::write('debug', true);

        //$lignecommandeclient2sdes = $this->Factureclients->Lignefactureclients->find('all')->where(["Lignefactureclients.factureclient_id=" . $id, "Lignefactureclients.type=2"])->first();
        $lignecommandeclient2sdes = $connection->execute("SELECT lc.* FROM lignefactureclients lc WHERE description!='' and description is not null and lc.type=2 and lc.factureclient_id='" . $id . "'")->fetch('assoc');


        $this->loadModel('Articles');
        $societes = $this->fetchTable('Societes')->find('all')->where(['id' => 23])->first();

        $img = file_get_contents($w . '/img/logo.png');
        $data = base64_encode($img);

        $imggg = file_get_contents($w . '/img/logosignature/qrcode_www.linkedin.com.png');
        $dataa = base64_encode($imggg);

        // Capture le contenu HTML
        ob_start();
        require(ROOT . DS . 'templates' . DS . 'Projets' . DS . 'imprimefactclient.php');
        $htmlContent = ob_get_clean();

        // Configuration de Dompdf
        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml($htmlContent);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Nommer le PDF et stream le fichier dans le navigateur
        $pdfFilename = "Facture client " . $commandeclient->numero . ".pdf"; // Nom du fichier PDF
        $dompdf->stream($pdfFilename, array("Attachment" => false));
    }

    public function downloadcmdclient($id)
    {
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

        $domainName = $_SERVER['HTTP_HOST'];
        $requestUri = $_SERVER['REQUEST_URI'];
        $segments = explode('/', trim($requestUri, '/')); // Découpe l'URL en segments

        $baseSegment = isset($segments[0]) ? '/' . $segments[0] : '/';

        $wr = $protocol . $domainName . $baseSegment;
        $this->loadModel('Commandeclients');
        $this->loadModel('Lignecommandeclients');
        $this->loadModel('Depots');
        $this->loadModel('Pointdeventes');
        $this->loadModel('Clients');

        // Récupérer les données nécessaires
        $commandeclient = $this->Commandeclients->get($id, [
            'contain' => ['Conditionreglements', 'Delailivraisons', 'Methodeexpeditions', 'Lignecommandeclients', 'Clients', 'Projets', 'Incoterms', 'Devises'],
        ]);

        $compbanq = '';

        if ($commandeclient->projet_id != null) {
            $projeet = $this->fetchTable('Projets')->find('all')->where(['id' => $commandeclient->projet_id])->first();

            // if ($projeet['banque_id'] && $commandeclient['devis_id']) {
            //     $comptebanq = $this->fetchTable('ComptesBank')->find('all')->where([
            //         'ComptesBank.banque_id' => $projeet['banque_id'],
            //         'ComptesBank.devise_id' => $commandeclient['devis_id']
            //     ])->first();

            //     $compbanq = $comptebanq['compte'];
            // }
        }
        if ($commandeclient->banque_id != null) {

            if ($commandeclient['banque_id'] && $commandeclient['devis_id']) {
                $comptebanq = $this->fetchTable('ComptesBank')->find('all')->where(['ComptesBank.banque_id=' . $commandeclient['banque_id'], 'ComptesBank.devise_id=' . $commandeclient['devis_id']])->first();
                // $banquee = $connection->execute("SELECT compte FROM comptesBank WHERE id = '" . $projet[0]['comptesBank_id'] . "'")->fetchAll('assoc');
                $compbanq = $comptebanq['compte'];
            }
        }
        $countlignes = $this->fetchTable('Lignecommandeclients')->find('all')->where(["Lignecommandeclients.commandeclient_id=" . $id, "Lignecommandeclients.type=1"]); //->first();
        $connection = ConnectionManager::get('default');
        $lignecommandeclient2sdes = $this->Commandeclients->Lignecommandeclients->find('all')->where(["Lignecommandeclients.commandeclient_id=" . $id, "Lignecommandeclients.type=2"])->first();

        $indexcc = count($countlignes->toArray());
        $this->loadModel('Articles');
        $societes = $this->fetchTable('Societes')->find('all')->where(['id' => 23])->first();

        $img = file_get_contents($wr . '/img/logo.png');
        $data = base64_encode($img);

        $imggg = file_get_contents($wr . '/img/logosignature/qrcode_www.linkedin.com.png');
        $dataa = base64_encode($imggg);

        // Capture le contenu HTML
        ob_start();
        require(ROOT . DS . 'templates' . DS . 'Projets' . DS . 'imprimerview.php');
        $htmlContent = ob_get_clean();

        // Configuration de Dompdf
        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml($htmlContent);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Nommer le PDF et stream le fichier dans le navigateur
        $pdfFilename = "Commande client " . $commandeclient->code . ".pdf"; // Nom du fichier PDF
        $dompdf->stream($pdfFilename, array("Attachment" => false));
    }
    public function downloadcommande($id)
    {
        $this->loadModel('Commandeclients');
        $this->loadModel('Lignecommandeclients');
        $this->loadModel('Depots');
        $this->loadModel('Pointdeventes');
        $this->loadModel('Clients');

        $this->loadModel('Demandeoffredeprixes');
        $this->loadModel('Commandefournisseurs');
        $commandefournisseur = $this->Commandefournisseurs->get($id, [
            'contain' => [
                'Fournisseurs',
                'Incoterms' => ['strategy' => 'select'],
                'Devises' => ['strategy' => 'select']
            ]
        ]);
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

        $domainName = $_SERVER['HTTP_HOST'];
        $requestUri = $_SERVER['REQUEST_URI'];
        $segments = explode('/', trim($requestUri, '/')); // Découpe l'URL en segments

        $baseSegment = isset($segments[0]) ? '/' . $segments[0] : '/';

        $wr = $protocol . $domainName . $baseSegment;
        // debug($commandefournisseur);
        $fournisseurs = $this->Commandefournisseurs->Fournisseurs->find('list', ['limit' => 200]);
        $this->loadModel('Lignecommandefournisseurs');
        $lignecommandefournisseurs = $this->Lignecommandefournisseurs->find('all')->contain(['Articles'])->where(["Lignecommandefournisseurs.commandefournisseur_id=" . $id . " "]);
        //debug($lignecommandeclients);
        $this->loadModel('Articles');
        $articles = $this->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'designiation']);
        $commandefournisseurs = $this->Commandefournisseurs->find('all')->contain(['Fournisseurs']);

        if ($commandefournisseur['fournisseur_id']) {
            $fournisseur = $this->Commandefournisseurs->Fournisseurs->get($commandefournisseur['fournisseur_id'], [
                'contain' => []
            ]);
            if ($fournisseur->logo) {
                $logo = str_replace('%20', ' ', $fournisseur->logo);
                $extension = pathinfo($logo, PATHINFO_EXTENSION);
                $extensionWithoutDot = ltrim($extension, '.');
                if ($extensionWithoutDot == 'jpg') {
                    $extensionWithoutDot = 'jpeg';
                }
                $img = file_get_contents(
                    $wr . '/webroot/img/logofournisseurs/' . $logo . ''
                );

                if ($img !== false) {
                    $data = base64_encode($img);
                } else {
                    $imggg = file_get_contents(
                        $wr . '/img/logo.png'
                    );
                    $data = base64_encode($imggg);
                    $extensionWithoutDot = 'png';
                }
            } else {
                $imggg = file_get_contents(
                    $wr . '/img/logo.png'
                );
                $data = base64_encode($imggg);
                $extensionWithoutDot = 'png';
            }
        }


        $compbanq = '';

        // if ($commandeclient->projet_id != null) {
        //     $projeet = $this->fetchTable('Projets')->find('all')->where(['id' => $commandeclient->projet_id])->first();

        //     if ($projeet['banque_id'] && $commandeclient['devis_id']) {
        //         $comptebanq = $this->fetchTable('ComptesBank')->find('all')->where([
        //             'ComptesBank.banque_id' => $projeet['banque_id'],
        //             'ComptesBank.devise_id' => $commandeclient['devis_id']
        //         ])->first();

        //         $compbanq = $comptebanq['compte'];
        //     }
        // }

        $this->loadModel('Articles');
        $societes = $this->fetchTable('Societes')->find('all')->where(['id' => 23])->first();

        $img = file_get_contents($wr . '/img/logo.png');
        $data = base64_encode($img);

        $imggg = file_get_contents($wr . '/img/logosignature/qrcode_www.linkedin.com.png');
        $dataa = base64_encode($imggg);

        // Capture le contenu HTML
        ob_start();
        require(ROOT . DS . 'templates' . DS . 'Projets' . DS . 'imprimcommande.php');
        $htmlContent = ob_get_clean();

        // Configuration de Dompdf
        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml($htmlContent);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        //debug($commandefournisseur);die;
        // Nommer le PDF et stream le fichier dans le navigateur
        $pdfFilename = "Commande fournisseur " . $commandefournisseur->numero . ".pdf"; // Nom du fichier PDF
        $dompdf->stream($pdfFilename, array("Attachment" => false));
    }
    public function downloadcommandetest($id)
    {
        $this->loadModel('Commandeclients');
        $this->loadModel('Lignecommandeclients');
        $this->loadModel('Depots');
        $this->loadModel('Pointdeventes');
        $this->loadModel('Clients');

        $this->loadModel('Demandeoffredeprixes');
        $this->loadModel('Commandefournisseurs');
        $commandefournisseur = $this->Commandefournisseurs->get($id, [
            'contain' => [
                'Fournisseurs',
                'Incoterms' => ['strategy' => 'select'],
                'Devises' => ['strategy' => 'select']
            ]
        ]);
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

        $domainName = $_SERVER['HTTP_HOST'];
        $requestUri = $_SERVER['REQUEST_URI'];
        $segments = explode('/', trim($requestUri, '/')); // Découpe l'URL en segments

        $baseSegment = isset($segments[0]) ? '/' . $segments[0] : '/';

        $wr = $protocol . $domainName . $baseSegment;
        // Configure::write('debug', true);
        // debug($commandefournisseur);
        $fournisseurs = $this->Commandefournisseurs->Fournisseurs->find('list', ['limit' => 200]);
        $this->loadModel('Lignecommandefournisseurs');
        $lignecommandefournisseurs = $this->Lignecommandefournisseurs->find('all')->contain(['Articles'])->where(["Lignecommandefournisseurs.commandefournisseur_id=" . $id . " "]);
        //debug($lignecommandeclients);
        $this->loadModel('Articles');
        $articles = $this->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'designiation']);
        $commandefournisseurs = $this->Commandefournisseurs->find('all')->contain(['Fournisseurs']);

        if ($commandefournisseur['fournisseur_id']) {
            $fournisseur = $this->Commandefournisseurs->Fournisseurs->get($commandefournisseur['fournisseur_id'], [
                'contain' => []
            ]);
            if ($fournisseur->logo) {
                $logo = str_replace('%20', ' ', $fournisseur->logo);
                $extension = pathinfo($logo, PATHINFO_EXTENSION);
                $extensionWithoutDot = ltrim($extension, '.');
                if ($extensionWithoutDot == 'jpg') {
                    $extensionWithoutDot = 'jpeg';
                }
                $img = file_get_contents(
                    $wr . '/webroot/img/logofournisseurs/' . $logo . ''
                );

                if ($img !== false) {
                    $data = base64_encode($img);
                } else {
                    $imggg = file_get_contents(
                        $wr . '/img/logo.png'
                    );
                    $data = base64_encode($imggg);
                    $extensionWithoutDot = 'png';
                }
            } else {
                $imggg = file_get_contents(
                    $wr . '/img/logo.png'
                );
                $data = base64_encode($imggg);
                $extensionWithoutDot = 'png';
            }
        }


        $compbanq = '';

        // if ($commandeclient->projet_id != null) {
        //     $projeet = $this->fetchTable('Projets')->find('all')->where(['id' => $commandeclient->projet_id])->first();

        //     if ($projeet['banque_id'] && $commandeclient['devis_id']) {
        //         $comptebanq = $this->fetchTable('ComptesBank')->find('all')->where([
        //             'ComptesBank.banque_id' => $projeet['banque_id'],
        //             'ComptesBank.devise_id' => $commandeclient['devis_id']
        //         ])->first();

        //         $compbanq = $comptebanq['compte'];
        //     }
        // }

        $this->loadModel('Articles');
        $societes = $this->fetchTable('Societes')->find('all')->where(['id' => 23])->first();

        $img = file_get_contents($wr . '/img/logo.png');
        $data = base64_encode($img);

        $imggg = file_get_contents($wr . '/img/logosignature/qrcode_www.linkedin.com.png');
        $dataa = base64_encode($imggg);

        // Capture le contenu HTML
        ob_start();
        require(ROOT . DS . 'templates' . DS . 'Projets' . DS . 'imprimcommande.php');
        $htmlContent = ob_get_clean();

        // Configuration de Dompdf
        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml($htmlContent);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        //debug($commandefournisseur);die;
        // Nommer le PDF et stream le fichier dans le navigateur
        $pdfFilename = "Commande fournisseur " . $commandefournisseur->numero . ".pdf"; // Nom du fichier PDF
        $dompdf->stream($pdfFilename, array("Attachment" => false));
    }
    public function downloadPdftest($id)
    {
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

        $domainName = $_SERVER['HTTP_HOST'];
        $requestUri = $_SERVER['REQUEST_URI'];
        $segments = explode('/', trim($requestUri, '/')); // Découpe l'URL en segments

        $baseSegment = isset($segments[0]) ? '/' . $segments[0]  : '/';

        $wr = $protocol . $domainName . $baseSegment;
        $this->loadModel('Commandeclients');
        $this->loadModel('Lignecommandeclients');
        $this->loadModel('Depots');
        $this->loadModel('Pointdeventes');
        $this->loadModel('Clients');

        // Récupérer les données nécessaires
        $commandeclient = $this->Commandeclients->get($id, [
            'contain' => ['Conditionreglements', 'Delailivraisons', 'Methodeexpeditions', 'Lignecommandeclients', 'Clients', 'Projets', 'Incoterms', 'Devises'],
        ]);

        $compbanq = '';

        if ($commandeclient->projet_id != null) {
            $projeet = $this->fetchTable('Projets')->find('all')->where(['id' => $commandeclient->projet_id])->first();

            if ($projeet['banque_id'] && $commandeclient['devis_id']) {
                $comptebanq = $this->fetchTable('ComptesBank')->find('all')->where([
                    'ComptesBank.banque_id' => $projeet['banque_id'],
                    'ComptesBank.devise_id' => $commandeclient['devis_id']
                ])->first();

                $compbanq = $comptebanq['compte'];
            }
        }

        $this->loadModel('Articles');
        $societes = $this->fetchTable('Societes')->find('all')->where(['id' => 23])->first();

        $img = file_get_contents($wr . '/img/logo.png');
        $data = base64_encode($img);

        $imggg = file_get_contents($wr . '/genuis/img/logosignature/qrcode_www.linkedin.com.png');
        $dataa = base64_encode($imggg);

        // Capture le contenu HTML
        ob_start();
        require(ROOT . DS . 'templates' . DS . 'Projets' . DS . 'imprimeviewtest.php');
        $htmlContent = ob_get_clean();

        // Configuration de Dompdf
        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml($htmlContent);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Nommer le PDF et stream le fichier dans le navigateur
        $pdfFilename = "Proposition commerciale " . $commandeclient->code . ".pdf"; // Nom du fichier PDF
        $dompdf->stream($pdfFilename, array("Attachment" => false));
    }
    public function downloadPdf23($id)
    {

        $this->loadModel('Commandeclients');
        $this->loadModel('Lignecommandeclients');
        $this->loadModel('Depots');
        $this->loadModel('Pointdeventes');
        $this->loadModel('Clients');
        //Configure::write('debug', true);
        // Récupérer les données nécessaires
        $commandeclient = $this->Commandeclients->get($id, [
            'contain' => ['Conditionreglements', 'Delailivraisons', 'Methodeexpeditions', 'Lignecommandeclients', 'Clients', 'Projets', 'Incoterms', 'Devises'],
        ]);

        $compbanq = '';

        if ($commandeclient->projet_id != null) {
            $projeet = $this->fetchTable('Projets')->find('all')->where(['id' => $commandeclient->projet_id])->first();

            if ($projeet['banque_id'] && $commandeclient['devis_id']) {
                $comptebanq = $this->fetchTable('ComptesBank')->find('all')->where([
                    'ComptesBank.banque_id' => $projeet['banque_id'],
                    'ComptesBank.devise_id' => $commandeclient['devis_id']
                ])->first();

                $compbanq = $comptebanq['compte'];
            }
        }
        $lignecommandeclient2sdes = $this->Commandeclients->Lignecommandeclients->find('all')->where(["Lignecommandeclients.commandeclient_id=" . $id, "Lignecommandeclients.type=2"])->first();

        $countlignes = $this->fetchTable('Lignecommandeclients')->find('all')->where(["Lignecommandeclients.commandeclient_id=" . $id, "Lignecommandeclients.type=1"]); //->first();

        $indexcc = count($countlignes->toArray());

        $this->loadModel('Articles');
        $societes = $this->fetchTable('Societes')->find('all')->where(['id' => 23])->first();

        $img = file_get_contents('https://geniusbusiness.isofterp.com/img/logo.png');
        $data = base64_encode($img);

        $imggg = file_get_contents('https://geniusbusiness.isofterp.com/genuis/img/logosignature/qrcode_www.linkedin.com.png');
        $dataa = base64_encode($imggg);

        // Capture le contenu HTML
        ob_start();
        require(ROOT . DS . 'templates' . DS . 'Projets' . DS . 'imprimeview23.php');
        $htmlContent = ob_get_clean();

        // Configuration de Dompdf
        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml($htmlContent);

        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Nommer le PDF et stream le fichier dans le navigateur
        $pdfFilename = "Proposition commerciale " . $commandeclient->code . ".pdf"; // Nom du fichier PDF
        $dompdf->stream($pdfFilename, array("Attachment" => false));
    }
    public function downloadPdfnew1($id)
    {
        //Configure::write('debug', true); 

        $this->loadModel('Commandeclients');
        $this->loadModel('Lignecommandeclients');
        $this->loadModel('Depots');
        $this->loadModel('Pointdeventes');
        $this->loadModel('Clients');
        //Configure::write('debug', true);
        // Récupérer les données nécessaires
        $commandeclient = $this->Commandeclients->get($id, [
            'contain' => ['Conditionreglements', 'Delailivraisons', 'Methodeexpeditions', 'Lignecommandeclients', 'Clients', 'Projets', 'Incoterms', 'Devises'],
        ]);

        $compbanq = '';

        if ($commandeclient->projet_id != null) {
            $projeet = $this->fetchTable('Projets')->find('all')->where(['id' => $commandeclient->projet_id])->first();

            if ($projeet['banque_id'] && $commandeclient['devis_id']) {
                $comptebanq = $this->fetchTable('ComptesBank')->find('all')->where([
                    'ComptesBank.banque_id' => $projeet['banque_id'],
                    'ComptesBank.devise_id' => $commandeclient['devis_id']
                ])->first();

                $compbanq = $comptebanq['compte'];
            }
        }
        $lignecommandeclient2sdes = $this->Commandeclients->Lignecommandeclients->find('all')->where(["Lignecommandeclients.commandeclient_id=" . $id, "Lignecommandeclients.type=2"])->first();

        $countlignes = $this->fetchTable('Lignecommandeclients')->find('all')->where(["Lignecommandeclients.commandeclient_id=" . $id, "Lignecommandeclients.type=1"]); //->first();

        $indexcc = count($countlignes->toArray());

        $this->loadModel('Articles');
        $societes = $this->fetchTable('Societes')->find('all')->where(['id' => 23])->first();

        $img = file_get_contents('https://geniusbusiness.isofterp.com/img/logo.png');
        $data = base64_encode($img);

        $imggg = file_get_contents('https://geniusbusiness.isofterp.com/genuis/img/logosignature/qrcode_www.linkedin.com.png');
        $dataa = base64_encode($imggg);

        // Capture le contenu HTML
        ob_start();
        require(ROOT . DS . 'templates' . DS . 'Projets' . DS . 'imprimeviewnew1.php');
        $htmlContent = ob_get_clean();

        // Configuration de Dompdf
        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml($htmlContent);

        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Nommer le PDF et stream le fichier dans le navigateur
        $pdfFilename = "Proposition commerciale " . $commandeclient->code . ".pdf"; // Nom du fichier PDF
        $dompdf->stream($pdfFilename, array("Attachment" => false));
    }
    public function downloadPdfnew($id)
    {
        // Configure::write('debug', true); 

        $this->loadModel('Commandeclients');
        $this->loadModel('Lignecommandeclients');
        $this->loadModel('Depots');
        $this->loadModel('Pointdeventes');
        $this->loadModel('Clients');
        //Configure::write('debug', true);
        // Récupérer les données nécessaires
        $commandeclient = $this->Commandeclients->get($id, [
            'contain' => ['Conditionreglements', 'Delailivraisons', 'Methodeexpeditions', 'Lignecommandeclients', 'Clients', 'Projets', 'Incoterms', 'Devises'],
        ]);

        $compbanq = '';
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

        $domainName = $_SERVER['HTTP_HOST'];
        $requestUri = $_SERVER['REQUEST_URI'];
        $segments = explode('/', trim($requestUri, '/')); // Découpe l'URL en segments

        $baseSegment = isset($segments[0]) ? '/' . $segments[0]  : '/';

        $wr = $protocol . $domainName . $baseSegment;
        if ($commandeclient->projet_id != null) {
            $projeet = $this->fetchTable('Projets')->find('all')->where(['id' => $commandeclient->projet_id])->first();

            if ($projeet['banque_id'] && $commandeclient['devis_id']) {
                $comptebanq = $this->fetchTable('ComptesBank')->find('all')->where([
                    'ComptesBank.banque_id' => $projeet['banque_id'],
                    'ComptesBank.devise_id' => $commandeclient['devis_id']
                ])->first();

                $compbanq = $comptebanq['compte'];
            }
        }
        $lignecommandeclient2sdes = $this->Commandeclients->Lignecommandeclients->find('all')->where(["Lignecommandeclients.commandeclient_id=" . $id, "Lignecommandeclients.type=2"])->first();

        $countlignes = $this->fetchTable('Lignecommandeclients')->find('all')->where(["Lignecommandeclients.commandeclient_id=" . $id, "Lignecommandeclients.type=1"]); //->first();

        $indexcc = count($countlignes->toArray());

        $this->loadModel('Articles');
        $societes = $this->fetchTable('Societes')->find('all')->where(['id' => 23])->first();

        $img = file_get_contents($wr . '/img/logo.png');
        $data = base64_encode($img);

        $imggg = file_get_contents($wr . '/img/logosignature/qrcode_www.linkedin.com.png');
        $dataa = base64_encode($imggg);

        // Capture le contenu HTML
        ob_start();
        require(ROOT . DS . 'templates' . DS . 'Projets' . DS . 'imprimeviewnew.php');
        $htmlContent = ob_get_clean();

        // Configuration de Dompdf
        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml($htmlContent);

        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Nommer le PDF et stream le fichier dans le navigateur
        $pdfFilename = "Proposition commerciale " . $commandeclient->code . ".pdf"; // Nom du fichier PDF
        $dompdf->stream($pdfFilename, array("Attachment" => false));
    }

    public function downloadPdf($id)
    {
        // Configure::write('debug', true); 

        $this->loadModel('Commandeclients');
        $this->loadModel('Lignecommandeclients');
        $this->loadModel('Depots');
        $this->loadModel('Pointdeventes');
        $this->loadModel('Clients');
        //Configure::write('debug', true);
        // Récupérer les données nécessaires
        $commandeclient = $this->Commandeclients->get($id, [
            'contain' => ['Conditionreglements', 'Delailivraisons', 'Methodeexpeditions', 'Lignecommandeclients', 'Clients', 'Projets', 'Incoterms', 'Devises'],
        ]);
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

        $domainName = $_SERVER['HTTP_HOST'];
        $requestUri = $_SERVER['REQUEST_URI'];
        $segments = explode('/', trim($requestUri, '/')); // Découpe l'URL en segments

        $baseSegment = isset($segments[0]) ? '/' . $segments[0]  : '/';

        $wr = $protocol . $domainName . $baseSegment;
        $compbanq = '';

        if ($commandeclient->projet_id != null) {
            $projeet = $this->fetchTable('Projets')->find('all')->where(['id' => $commandeclient->projet_id])->first();

            if ($projeet['banque_id'] && $commandeclient['devis_id']) {
                $comptebanq = $this->fetchTable('ComptesBank')->find('all')->where([
                    'ComptesBank.banque_id' => $projeet['banque_id'],
                    'ComptesBank.devise_id' => $commandeclient['devis_id']
                ])->first();

                $compbanq = $comptebanq['compte'];
            }
        }
        $lignecommandeclient2sdes = $this->Commandeclients->Lignecommandeclients->find('all')->where(["Lignecommandeclients.commandeclient_id=" . $id, "Lignecommandeclients.type=2"])->first();

        $countlignes = $this->fetchTable('Lignecommandeclients')->find('all')->where(["Lignecommandeclients.commandeclient_id=" . $id, "Lignecommandeclients.type=1"]); //->first();

        $indexcc = count($countlignes->toArray());

        $this->loadModel('Articles');
        $societes = $this->fetchTable('Societes')->find('all')->where(['id' => 23])->first();

        $img = file_get_contents($wr . '/img/logo.png');
        $data = base64_encode($img);

        $imggg = file_get_contents($wr . '/img/logosignature/qrcode_www.linkedin.com.png');
        $dataa = base64_encode($imggg);

        // Capture le contenu HTML
        ob_start();
        require(ROOT . DS . 'templates' . DS . 'Projets' . DS . 'imprimeview.php');
        $htmlContent = ob_get_clean();

        // Configuration de Dompdf
        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml($htmlContent);

        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Nommer le PDF et stream le fichier dans le navigateur
        $pdfFilename = "Proposition commerciale " . $commandeclient->code . ".pdf"; // Nom du fichier PDF
        $dompdf->stream($pdfFilename, array("Attachment" => false));
    }
    public function downloadPdfimp11($id)
    {
        $this->loadModel('Commandeclients');
        $this->loadModel('Lignecommandeclients');
        $this->loadModel('Depots');
        $this->loadModel('Pointdeventes');
        $this->loadModel('Clients');

        // Récupérer les données nécessaires
        $commandeclient = $this->Commandeclients->get($id, [
            'contain' => [
                'Conditionreglements',
                'Delailivraisons',
                'Methodeexpeditions',
                'Lignecommandeclients',
                'Clients',
                'Projets',
                'Incoterms',
                'Devises'
            ]
        ]);

        $compbanq = '';

        if ($commandeclient->projet_id != null) {
            $projet = $this->fetchTable('Projets')->find('all')
                ->where(['id' => $commandeclient->projet_id])
                ->first();

            if ($projet['banque_id'] && $commandeclient['devis_id']) {
                $comptebanq = $this->fetchTable('ComptesBank')->find('all')->where([
                    'ComptesBank.banque_id' => $projet['banque_id'],
                    'ComptesBank.devise_id' => $commandeclient['devis_id']
                ])->first();

                $compbanq = $comptebanq['compte'];
            }
        }

        $lignecommandeclient2sdes = $this->Commandeclients->Lignecommandeclients
            ->find('all')
            ->where(["Lignecommandeclients.commandeclient_id" => $id, "Lignecommandeclients.type" => 2])
            ->first();

        $countlignes = $this->fetchTable('Lignecommandeclients')
            ->find('all')
            ->where(["Lignecommandeclients.commandeclient_id" => $id, "Lignecommandeclients.type" => 1]);

        $indexcc = count($countlignes->toArray());

        $this->loadModel('Articles');
        $societes = $this->fetchTable('Societes')
            ->find('all')
            ->where(['id' => 23])
            ->first();

        // Charger les images et les encoder en base64
        $logo = base64_encode(file_get_contents($wr . '/img/logo.png'));
        $qrcode = base64_encode(file_get_contents($wr . '/img/logosignature/qrcode_www.linkedin.com.png'));

        // Capture le contenu HTML du fichier de vue
        ob_start();
        require(ROOT . DS . 'templates' . DS . 'Projets' . DS . 'imprimeview.php');
        $htmlContent = ob_get_clean();

        // Configurer Dompdf
        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml($htmlContent);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Nom du fichier PDF
        $pdfFilename = "Proposition_commerciale_" . $commandeclient->code . ".pdf";

        // Chemin de sauvegarde dans un dossier de votre projet
        $savePath = ROOT . DS . 'webroot' . DS . 'pdfs' . DS . $pdfFilename;

        // Sauvegarder le PDF sur le serveur
        file_put_contents($savePath, $dompdf->output());

        // Télécharger le fichier PDF automatiquement
        $response = $this->response->withFile($savePath, [
            'download' => true,
            'name' => $pdfFilename,
        ]);

        return $response;
    }
    public function downloadPdfimp($id)
    {
        $this->loadModel('Commandeclients');
        $this->loadModel('Lignecommandeclients');

        // Récupérer les données nécessaires
        // $commandeclient = $this->Commandeclients->get($id, [
        //     'contain' => ['Conditionreglements', 'Delailivraisons', 'Lignecommandeclients', 'Clients']
        // ]);
        $commandeclient = $this->Commandeclients->get($id, [
            'contain' => ['Conditionreglements', 'Delailivraisons', 'Methodeexpeditions', 'Lignecommandeclients', 'Clients', 'Projets', 'Incoterms', 'Devises'],
        ]);
        // Capture du contenu HTML pour générer le PDF
        $societes = $this->fetchTable('Societes')->find('all')->first();
        $lignecommandeclient2sdes = $this->Commandeclients->Lignecommandeclients->find('all')->where(["Lignecommandeclients.commandeclient_id=" . $id, "Lignecommandeclients.type=2"])->first();

        ob_start();
        require(ROOT . DS . 'templates' . DS . 'Projets' . DS . 'imprimeviewnew.php');
        $htmlContent = ob_get_clean();

        // Configurer Dompdf
        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml($htmlContent);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Sauvegarder le PDF temporairement
        $pdfFilename = "commande_" . $commandeclient->code . ".pdf";
        $pdfPath = ROOT . DS . 'webroot' . DS . 'pdfs' . DS . $pdfFilename;
        file_put_contents($pdfPath, $dompdf->output());
        $imageFilename = "commande_" . $commandeclient->code . ".jpg";
        // Convertir le PDF en image avec Imagick
        // $imagick = new \Imagick();
        // $imagick->setResolution(300, 300);
        // $imagick->readImage($pdfPath . '[0]'); // Test avec un PDF simple

        // $imagick->setImageColorspace(\Imagick::COLORSPACE_RGB);
        // $imagick->setImageAlphaChannel(\Imagick::ALPHACHANNEL_REMOVE);
        // $imagick->setImageFormat('jpg');
        // $imagePath = ROOT . DS . 'webroot' . DS . 'img' . DS . $imageFilename;
        // $imagick->writeImage($imagePath);
        // $imagick->clear();
        // $imagick->destroy();
        // Supprimer le fichier PDF temporaire
        unlink($pdfPath);
        $pdfFilename = "Proposition_commerciale_" . $commandeclient->code . ".pdf";

        // Chemin de sauvegarde dans un dossier de votre projet
        $savePath = ROOT . DS . 'webroot' . DS . 'pdfs' . DS . $pdfFilename;

        // Sauvegarder le PDF sur le serveur
        file_put_contents($savePath, $dompdf->output());

        // Télécharger le fichier PDF automatiquement
        $response = $this->response->withFile($savePath, [
            'download' => true,
            'name' => $pdfFilename,
        ]);
        // Retourner une réponse avec l'image générée
        // $response = $this->response->withFile($imagePath, [
        //     'download' => true,
        //     'name' => $imageFilename,
        // ]);

        return $response;
    }
    public function downloadPdfimp12($id)
    {
        $this->loadModel('Commandeclients');
        $this->loadModel('Lignecommandeclients');

        // Récupérer les données nécessaires
        $commandeclient = $this->Commandeclients->get($id, [
            'contain' => ['Conditionreglements', 'Delailivraisons', 'Lignecommandeclients', 'Clients']
        ]);

        // Capture du contenu HTML pour générer le PDF
        ob_start();
        require(ROOT . DS . 'templates' . DS . 'Projets' . DS . 'imprimeview.php');
        $htmlContent = ob_get_clean();

        // Configurer Dompdf
        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml($htmlContent);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Sauvegarder le PDF temporairement
        $pdfFilename = "commande_" . $commandeclient->code . ".pdf";
        $pdfPath = ROOT . DS . 'webroot' . DS . 'pdfs' . DS . $pdfFilename;
        file_put_contents($pdfPath, $dompdf->output());
        $imageFilename = "commande_" . $commandeclient->code . ".jpg";
        // Convertir le PDF en image avec Imagick
        $imagick = new \Imagick();
        $imagick->setResolution(300, 300);
        $imagick->readImage($pdfPath . '[0]'); // Test avec un PDF simple

        $imagick->setImageColorspace(\Imagick::COLORSPACE_RGB);
        $imagick->setImageAlphaChannel(\Imagick::ALPHACHANNEL_REMOVE);
        $imagick->setImageFormat('jpg');
        $imagePath = ROOT . DS . 'webroot' . DS . 'img' . DS . $imageFilename;
        $imagick->writeImage($imagePath);
        $imagick->clear();
        $imagick->destroy();
        // Supprimer le fichier PDF temporaire
        unlink($pdfPath);
        $pdfFilename = "Proposition_commerciale_" . $commandeclient->code . ".pdf";

        // Chemin de sauvegarde dans un dossier de votre projet
        $savePath = ROOT . DS . 'webroot' . DS . 'pdfs' . DS . $pdfFilename;

        // Sauvegarder le PDF sur le serveur
        file_put_contents($savePath, $dompdf->output());

        // Télécharger le fichier PDF automatiquement
        $response = $this->response->withFile($savePath, [
            'download' => false,
            'name' => $pdfFilename,
        ]);
        // Retourner une réponse avec l'image générée
        // $response = $this->response->withFile($imagePath, [
        //     'download' => true,
        //     'name' => $imageFilename,
        // ]);

        return $response;
    }


    public function downloadPdf12($id)
    {
        $this->loadModel('Commandeclients');
        $this->loadModel('Lignecommandeclients');
        $this->loadModel('Depots');
        $this->loadModel('Pointdeventes');
        $this->loadModel('Clients');

        // Récupérer les données nécessaires
        $commandeclient = $this->Commandeclients->get($id, [
            'contain' => ['Conditionreglements', 'Delailivraisons', 'Methodeexpeditions', 'Lignecommandeclients', 'Clients', 'Projets', 'Incoterms', 'Devises'],
        ]);

        $compbanq = '';

        if ($commandeclient->projet_id != null) {
            $projeet = $this->fetchTable('Projets')->find('all')->where(['id' => $commandeclient->projet_id])->first();

            if ($projeet['banque_id'] && $commandeclient['devis_id']) {
                $comptebanq = $this->fetchTable('ComptesBank')->find('all')->where([
                    'ComptesBank.banque_id' => $projeet['banque_id'],
                    'ComptesBank.devise_id' => $commandeclient['devis_id']
                ])->first();

                $compbanq = $comptebanq['compte'];
            }
        }

        $this->loadModel('Articles');
        $societes = $this->fetchTable('Societes')->find('all')->where(['id' => 23])->first();

        $img = file_get_contents('https://geniusbusiness.isofterp.com/img/logo.png');
        $data = base64_encode($img);

        $imggg = file_get_contents('https://geniusbusiness.isofterp.com/genuis/img/logosignature/qrcode_www.linkedin.com.png');
        $dataa = base64_encode($imggg);

        // Capture le contenu HTML
        ob_start();
        require(ROOT . DS . 'templates' . DS . 'Projets' . DS . 'imprimeview2929082024.php');
        $htmlContent = ob_get_clean();

        // Configuration de Dompdf
        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml($htmlContent);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Nommer le PDF et stream le fichier dans le navigateur
        $pdfFilename = "Proposition commerciale " . $commandeclient->code . ".pdf"; // Nom du fichier PDF
        $dompdf->stream($pdfFilename, array("Attachment" => false));
    }

    public function downloadPdfbc($id)
    {
        $this->loadModel('Commandeclients');
        $this->loadModel('Lignecommandeclients');
        $this->loadModel('Depots');
        $this->loadModel('Pointdeventes');
        $this->loadModel('Clients');

        // Récupérer les données nécessaires
        $commandeclient = $this->Commandeclients->get($id, [
            'contain' => ['Conditionreglements', 'Delailivraisons', 'Methodeexpeditions', 'Lignecommandeclients', 'Clients', 'Projets', 'Incoterms', 'Devises'],
        ]);

        $compbanq = '';
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

        $domainName = $_SERVER['HTTP_HOST'];
        $requestUri = $_SERVER['REQUEST_URI'];
        $segments = explode('/', trim($requestUri, '/')); // Découpe l'URL en segments

        $baseSegment = isset($segments[0]) ? '/' . $segments[0]  : '/';

        $wr = $protocol . $domainName . $baseSegment;
        if ($commandeclient->projet_id != null) {
            $projeet = $this->fetchTable('Projets')->find('all')->where(['id' => $commandeclient->projet_id])->first();

            if ($projeet['banque_id'] && $commandeclient['devis_id']) {
                $comptebanq = $this->fetchTable('ComptesBank')->find('all')->where([
                    'ComptesBank.banque_id' => $projeet['banque_id'],
                    'ComptesBank.devise_id' => $commandeclient['devis_id']
                ])->first();

                $compbanq = $comptebanq['compte'];
            }
        }

        $this->loadModel('Articles');
        $societes = $this->fetchTable('Societes')->find('all')->where(['id' => 23])->first();

        $img = file_get_contents($wr . '/img/logo.png');
        $data = base64_encode($img);

        $imggg = file_get_contents($wr . '/img/logosignature/qrcode_www.linkedin.com.png');
        $dataa = base64_encode($imggg);

        // Capture le contenu HTML
        ob_start();
        require(ROOT . DS . 'templates' . DS . 'Projets' . DS . 'imprimeview.php');
        $htmlContent = ob_get_clean();

        // Configuration de Dompdf
        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml($htmlContent);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Nommer le PDF et stream le fichier dans le navigateur
        $pdfFilename = "Proposition commerciale " . $commandeclient->code . ".pdf"; // Nom du fichier PDF
        $dompdf->stream($pdfFilename, array("Attachment" => false));
    }

    public function downloadPdf1($id)
    {
        $this->loadModel('Commandeclients');
        $this->loadModel('Lignecommandeclients');
        $this->loadModel('Depots');
        $this->loadModel('Pointdeventes');
        $this->loadModel('Clients');
        $commandeclient = $this->Commandeclients->get($id, [
            'contain' => ['Conditionreglements', 'Delailivraisons', 'Methodeexpeditions', 'Lignecommandeclients', 'Clients', 'Projets', 'Incoterms', 'Devises'],
        ]);
        $this->viewBuilder()->setLayout('adminlte');
        $this->viewBuilder()->enableAutoLayout(false);
        $this->viewBuilder()->setClassName('CakePdf.Pdf');
        $this->viewBuilder()->setOptions([
            'pdfConfig' => [
                'engine' => [
                    'className' => 'CakePdf.WkHtmlToPdf',
                    'binary' => '/usr/local/bin/wkhtmltopdf', // Chemin vers wkhtmltopdf
                ],
                'margin' => [
                    'bottom' => 15,
                    'left' => 50,
                    'right' => 30,
                    'top' => 45,
                ],
                'orientation' => 'portrait',
                'download' => true,
            ]
        ]);

        $this->set('commandeclient', $commandeclient);
        $this->RequestHandler->renderAs($this, 'pdf');

        $this->response = $this->response->withType('application/pdf');
        $this->response = $this->response->withDownload('Proposition_Commerciale.pdf');
    }
    public function ajoutaccees()
    {
        //  Configure::write('debug', true);
        $column = $this->request->getQuery('column');
        $interface = $this->request->getQuery('interface');
        $checkedColumns = $this->request->getQuery('columnsStatus');
        $user_id = $this->request->getAttribute('identity')->id;
        $this->loadModel('Accesrecherches');

        $accesrecherches = $this->Accesrecherches->find('all')->where(["Accesrecherches.user_id =" . $user_id, "Accesrecherches.interface ='" . $interface . "'"]);
        foreach ($accesrecherches as $key => $acc) {
            $this->Accesrecherches->delete($acc);
        }
        foreach ($checkedColumns as $key => $check) {

            $accesrecherche = $this->Accesrecherches->newEmptyEntity();
            $accesrecherche['date'] = date('Y-m-d H:i:s');
            $accesrecherche['user_id'] = $user_id;
            $accesrecherche['champ'] = $check['column'];
            if ($check['checked'] == 'true') {
                $accesrecherche['acces'] = 1;
            } else if ($check['checked'] == 'false') {
                $accesrecherche['acces'] = 0;
            }

            $accesrecherche['interface'] = $interface;
            //$accesrecherche = $this->Projets->patchEntity($accesrecherche, $accesrecherche);

            $this->Accesrecherches->save($accesrecherche);
        }


        echo json_encode(array('success' => true));
        exit;
    }
    public function envoyer()
    {
        $id = $this->request->getQuery('id');
        $typeof = $this->request->getQuery('typeof');
        $name = $this->request->getQuery('name');
        $email = $this->request->getQuery('mail');
        //var_dump($email);

        $mail = new PHPMailer(true);

        try {
            // Paramètres du serveur SMTP

            $mail->isSMTP();
            $mail->Host = 'mtdgroup.info';
            $mail->SMTPAuth = true;
            $mail->Username = 'send@mtdgroup.info';
            $mail->Password = 'Acga9u4TCn';
            $mail->SMTPSecure = '';
            $mail->Port = 587;
            $societe = $this->fetchTable('Societes')->find('all')
                ->first();
            // Destinataire et contenu de l'e-mail
            // debug($societe);
            $mail->setFrom($societe->mail, $societe->nom);
            $mail->addAddress($email);
            $mail->Subject = 'Demandes offres de prixs';
            $mail->Body = 'Hello ';
            /* $pdfFilePath = $this->imprimeview($typeof, $id, $name); // Replace with the actual path to your PDF file
            $mail->addAttachment($pdfFilePath); */
            $mail->SMTPOptions = [
                'ssl' => [
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                ]
            ];
            // Envoi de l'e-mail
            $mail->send();
            // return $this->redirect(['action' => 'index/' . $typeof]);

        } catch (Exception $e) {
            echo 'Erreur lors de l\'envoi de l\'e-mail : ', $mail->ErrorInfo;
        }
    }
    public function indexprojet()
    {
        $connection = ConnectionManager::get('default');
        $liste3Projets = $connection->execute('SELECT * FROM projets ORDER BY datemodification DESC LIMIT 3;')->fetchAll('assoc');
        $projetProspections = $this->fetchTable('Projets')->find('all')->where(['Projets.opportunite_id' => '1'])->toArray();
        $listeProjetParClients = $connection->execute('SELECT client_id, COUNT(*) as nombre_de_projets FROM projets GROUP BY client_id; ')->fetchAll('assoc');
        $projets = $this->fetchTable('Projets')->find('all')->contain(['Clients', 'Opportunites'])->toArray();
        $projetcount = $this->fetchTable('Projets')->find('all')->count();

        $this->set(compact('liste3Projets', 'projets', 'projetcount', 'listeProjetParClients', 'projetProspections'));
    }


    public function duplicateprojet($id = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_projet' . $abrv);
        $projet = 0;
        foreach ($liendd as $k => $liens) {
            if (@$liens['lien'] == 'projets') {
                $projet = $liens['ajout'];
            }
        }
        if (($projet <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $projet = $this->Projets->get($id, [
            'contain' => [],
        ]);
        $num = $this->Projets->find()->select([
            "num" =>
            'MAX(Projets.libelle)'
        ])->first();
        $numero = $num->num;
        if ($numero != null) {
            $inc = intval(substr($numero, 1, 5)) + 1;

            $c = str_pad("$inc", 5, '0', STR_PAD_LEFT);

            $code = str_pad($c, 7, 'PJ', STR_PAD_LEFT);
        } else {
            $code = "PJ00001";
        }
        $projet = $this->Projets->newEmptyEntity();
        if ($this->request->is('post')) {
            $projet['datemodification'] = date('Y-m-d H:i:s');
            $projet = $this->Projets->patchEntity($projet, $this->request->getData());
            if ($this->Projets->save($projet)) {
                $projet_id = $projet->id;
                // $this->misejour("Duplicate Projet", "add", $projet_id);
                $this->misejour("Projets", "duplicate", $id);
                $this->misejour("Projets", "add", $projet_id);
                if (isset($this->request->getData('data')['fichier']) && (!empty($this->request->getData('data')['fichier']))) {
                    foreach ($this->request->getData('data')['fichier'] as $i => $fich) {
                        if ($fich['sup1'] != 1) {
                            $logo = $fich['pdf'];
                            $name = $logo->getClientFilename();
                            $targetPath = WWW_ROOT . 'img' . DS . 'logoclients' . DS . $name;
                            if ($name) {
                                $logo->moveTo($targetPath);
                                $data['fichier'] = $name;
                            }
                            $this->loadModel('Pdfs');
                            $fichierpdf = $this->Pdfs->newEmptyEntity();
                            $data['projet_id'] = $projet_id;
                            $fichierpdf = $this->Pdfs->patchEntity($fichierpdf, $data);
                            $this->Pdfs->save($fichierpdf);
                            $this->misejour("Pdfs", "addprojet", $projet_id);
                            $this->misejour("Pdfs", "add", $fichierpdf->id);
                        }
                    }
                }
                if (isset($this->request->getData('data')['ligne']) && (!empty($this->request->getData('data')['ligne']))) {
                    foreach ($this->request->getData('data')['ligne'] as $i => $ligne) {
                        if ($ligne['sup1'] != 1) {
                            $this->loadModel('Responsableprojets');
                            $responsableprojets = $this->Responsableprojets->newEmptyEntity();
                            $data['projet_id'] = $projet_id;
                            $data['personnel_id'] = $ligne['personnel_id'];
                            $responsableprojets = $this->Responsableprojets->patchEntity($responsableprojets, $data);
                            $this->Responsableprojets->save($responsableprojets);
                            $this->misejour("Responsableprojets", "addprojet", $projet_id);
                            $this->misejour("Responsableprojets", "add", $responsableprojets->id);
                        }
                    }
                }

                return $this->redirect(['action' => 'index']);
            }
        }
        $this->loadModel('Clients');
        $this->loadModel('Opportunites');
        $this->loadModel('Personnels');
        $this->loadModel('Commercials');
        $this->loadModel('Banques');
        $this->loadModel('Devises');
        $devises = $this->fetchTable('Devises')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $banquesssss = $this->Banques->find('list', [
            'keyField' => 'id',
            'valueField' => function ($banque) {
                if ($banque->devise_id != null) {
                    $devises_name = $this->fetchTable('Devises')->find()
                        ->select(['name'])
                        ->where(['id' => $banque->devise_id])
                        ->first();
                }
                return $banque->name . '   ' . $devises_name->name;
            }
        ]);
        $this->loadModel('Responsableprojets');
        $lignes = $this->Responsableprojets->find('all')->where('Responsableprojets.projet_id =' . $id);
        $this->loadModel('Pdfs');
        $fichierpdfs = $this->Pdfs->find('all')->where('Pdfs.projet_id =' . $id);
        $proojet = $this->fetchTable('Projets')->find('all')->where(['Projets.id' => $id])->contain(['Banques', 'Devises', 'Opportunites', 'Personnels', 'Clients'])->first();
        $commercials = $this->Personnels->find('list', ['keyField' => 'id', 'valueField' => 'nom'])->where(['fonction_id' => 9]);
        $banques = $this->fetchTable('Banques')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $devises = $this->fetchTable('Devises')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $personnels = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom']);
        $opportunites = $this->Opportunites->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $clients = $this->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'nom']);
        $this->set(compact('proojet', 'projet', 'fichierpdfs', 'lignes', 'banquesssss', 'banques', 'devises', 'ban', 'projet', 'clients', 'code', 'opportunites', 'commercials', 'personnels'));
    }
    public function viewbandeconsultation($id = null, $id_dm = null, $projet_id = null)
    {
        // debug($id_dm);
        $id_projet = $projet_id;
        // debug($projet_id);
        $this->loadModel('Demandeoffredeprixes');
        $this->loadModel('Lignedemandeoffredeprixes');
        $this->loadModel('Articles');
        $this->loadModel('Fournisseurs');
        $this->loadModel('Bandeconsultations');
        $this->loadModel('Lignebandeconsultations');
        $this->loadModel('Lignelignebandeconsultations');
        $this->loadModel('Paiements');
        $this->loadModel('Devises');
        $this->loadModel('Conditionreglements');
        $this->loadModel('Methodeexpeditions');


        $bandeconsultation = $this->Bandeconsultations->get($id, [
            'contain' => ['Lignebandeconsultations', 'Demandeoffredeprixes']
        ]);

        $ligneas = $this->Lignebandeconsultations->find('all', ['keyfield' => 'id', 'valueField' => 'designiationA'])
            ->group(["nomar" => '(Lignebandeconsultations.article_id)'])
            ->where(["Lignebandeconsultations.demandeoffredeprix_id ='" . $id_dm . "'"])->toArray();
        // print_r($ligneas);
        // debug($id_dm);
        $lignefs = $this->Lignelignebandeconsultations->find('all')
            ->group(["nomfour" => '(Lignelignebandeconsultations.nameF)'])
            ->where(["Lignelignebandeconsultations.demandeoffredeprix_id = '" . $id_dm . "'"])->toArray();
        // $lignefs = $this->Lignebandeconsultations->find('all', ['keyfield' => 'id', 'valueField' => 'nameF'])
        //     ->group(["nomfour" => '(Lignebandeconsultations.nameF)'])
        //     ->where(["Lignebandeconsultations.demandeoffredeprix_id  ='" . $id_dm . "'"])->toArray();
        // print_r($lignefs);
        $fournisseurss = $this->Lignelignebandeconsultations->find('all', ['keyfield' => 'id', 'valueField' => 'nameF'])
            ->group(["namef" => '(Lignelignebandeconsultations.nameF)'])
            ->where(["Lignelignebandeconsultations.demandeoffredeprix_id  ='" . $id . "'"]);
        $articless = $this->Lignebandeconsultations->find('all', [
            'keyfield' => 'id',
            'valueField' => 'designiationA'
        ])
            ->group(["art" => 'Lignebandeconsultations.designiationA'])
            ->where([
                "Lignebandeconsultations.demandeoffredeprix_id = '" . $id . "'",
            ]);
        $fournisseurs = $this->Fournisseurs->find('list');
        $demandes = $this->Bandeconsultations->find()
            ->select(["dm" => '(Bandeconsultations.id)'])
            ->where(["Bandeconsultations.id ='" . $id . "'"])->first();
        // debug($demandes);
        $articles = $this->Articles->find('list', array('fields' => array('Articles.designiation')));
        $lignes = $this->Lignebandeconsultations->find('all')
            ->where(["Lignebandeconsultations.demandeoffredeprix_id ='" . $id_dm . "'"])->toArray();
        // debug($lignes);
        $ligneas = $this->Lignebandeconsultations->find('all', ['keyfield' => 'id', 'valueField' => 'designiationA'])
            ->group(["nomar" => '(Lignebandeconsultations.designiationA)', "id" => 'Lignebandeconsultations.id'])
            ->where(["Lignebandeconsultations.demandeoffredeprix_id ='" . $id_dm . "'"])->toArray();
        // debug($ligneas);
        // debug($id_dm);
        $lignefs = $this->Lignebandeconsultations->find('all', ['keyfield' => 'id', 'valueField' => 'nameF'])
            ->group(["nomfour" => '(Lignebandeconsultations.nameF)'])
            ->where(["Lignebandeconsultations.demandeoffredeprix_id  ='" . $id_dm . "'"])->toArray();
        // debug($lignefs);
        $fournisseurs = $this->Fournisseurs->find('list');
        $demandes = $this->Bandeconsultations->find()
            ->select(["dm" => '(Bandeconsultations.id)'])
            ->where(["Bandeconsultations.id ='" . $id . "'"])->first();
        // debug($demandes);
        $articles = $this->Articles->find('list', array('fields' => array('Articles.designiation')));
        $paiements = $this->Paiements->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $devises = $this->Devises->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $conditionreglements = $this->Conditionreglements->find('list', ['keyfield' => 'id', 'valueField' => 'conditionn']);
        $methodeexpeditions = $this->Methodeexpeditions->find('list', ['keyfield' => 'id', 'valueField' => 'methode']);
        $this->set(compact('paiements', 'devises', 'conditionreglements', 'methodeexpeditions', 'id_dm', 'articles', 'demandes', 'fournisseurs', 'ligneas', 'lignefs', 'bandeconsultation', 'typeof', 'projet_id', 'id_projet'));
    }
    public function modepaie($id = null)
    {
        $this->viewBuilder()->setLayout('def');
        $this->loadModel('Piecereglements');
        // $regs = $this->Piecereglements->find('all')->where(["Piecereglements.reglement_id  ='" . $id . "'"])->toArray();
        // debug($regs);
        $pieces = $this->Piecereglements->find()->where(['Piecereglements.reglement_id' => $id])->contain(['Paiements'])->all();
        $this->set(compact('pieces'));
    }
    public function fournisseurarticle()
    {
        $this->loadModel('Articles');
        $this->loadModel('Fournisseurs');
        $this->loadModel('Tagsfour');

        // debug('');die;
        $id = (int) $this->request->getQuery('fournisseur_id');

        $fournisseur = $this->Fournisseurs->find()->where(['Fournisseurs.id' => $id])->first();
        $tagfours = $this->Tagsfour->find('all')->where(['Tagsfour.fournisseurs_id' => $id])->contain('Listetags');
        // debug($tagfours->toArray());die;
        $gg = '(0';
        foreach ($tagfours as $i => $g) {
            $gg .= ',' . $g['categorie_d'];
        }
        $gg .= ')';
        //
        $index = $this->request->getQuery('index');
        $table = $this->request->getQuery('table');

        $articles = $this->Articles->find()->where(['Articles.typearticle' => 1, 'Articles.fournisseur_id' => $id/* , 'Articles.categorie_id in ('.$gg.')' */])->all();
        $select = '<option value="">Veuillez choisir !!</option>';
        foreach ($articles as $article) {
            $select .= '<option value="' . $article->id . '" >' . $article->nom . '</option>';
        }

        $fournisseurs = $this->Fournisseurs->find()->all();
        $select1 = '<option value="">Veuillez choisir !!</option>';
        foreach ($fournisseurs as $four) {
            $se = "";
            if ($four->id == $id) {
                $se = "selected";
            }
            $select1 .= '<option value="' . $four->id . '"  ' . $se . '>' . $four->name . '</option>';
        }

        echo json_encode(array('select1' => $select1, 'select' => $select, 'index' => $index));
        exit;

        //$this->set(compact('select'));
    }

    public function imprimret($id = null)
    {
        $compte = "";
        $this->viewBuilder()->setLayout('');
        $this->loadModel('Piecereglements');

        $pieces = $this->Piecereglements->get($id);
        $reglement = [];
        if ($pieces->reglement_id != null) {
            $reglement = $this->fetchTable('Reglements')->find()->where('Reglements.id=' . $pieces->reglement_id)->first();
        }
        $societe = $this->fetchTable('Societes')->find('all')->first();
        // debug($societe);
        $fournisseur = [];
        if ($reglement->fournisseur_id != null) {
            $fournisseur = $this->fetchTable('Fournisseurs')->find()->where('Fournisseurs.id=' . $reglement->fournisseur_id)->first();
        }
        $this->set(compact('pieces', 'reglement', 'societe', 'fournisseur'));
    }

    public function imprimtr($id = null)
    {
        $compte = "";
        $this->loadModel('Piecereglements');
        $pieces = $this->Piecereglements->get($id);
        $banque = [];
        if ($pieces->banque_id != null) {
            $banque = $this->fetchTable('Banques')->find()->where('Banques.id=' . $pieces->banque_id)->first();
        }
        if ($pieces->compte_id != null) {
            $compte = $this->fetchTable('Comptes')->find()->where('Comptes.id=' . $pieces->compte_id)->first();
        }
        $societe = $this->fetchTable('Societes')->find()->where('Societes.id=1')->first();

        $reglement = $this->fetchTable('Reglements')->find()->where('Reglements.id=' . $pieces->reglement_id)->first();
        $fournisseur = [];
        if ($reglement->fournisseur_id != null) {
            $fournisseur = $this->fetchTable('Fournisseurs')->find()->where('Fournisseurs.id=' . $reglement->fournisseur_id)->first();
        }
        $this->set(compact('pieces', 'reglement', 'fournisseur', 'societe', 'banque', 'compte'));
    }


    public function imprimstb($id = null)
    {
        // $this->viewBuilder()->setLayout('');
        $this->loadModel('Piecereglements');

        $pieces = $this->Piecereglements->get($id);
        $reglement = $this->fetchTable('Reglements')->find()->where('Reglements.id=' . $pieces->reglement_id)->first();
        $fournisseur = [];
        if ($reglement->fournisseur_id != null) {
            $fournisseur = $this->fetchTable('Fournisseurs')->find()->where('Fournisseurs.id=' . $reglement->fournisseur_id)->first();
        }

        $this->set(compact('pieces', 'reglement', 'fournisseur'));
    }
    public function imprimeviewbande($id = null, $id_dm = null, $idfr = null)
    {
        //Configure::write('debug', true);

        $this->loadModel('Commandeclients');
        $this->loadModel('Bandeconsultations');
        $this->loadModel('Demandeoffredeprixes');
        $this->loadModel('Lignedemandeoffredeprixes');
        $this->loadModel('Articles');
        $this->loadModel('Fournisseurs');
        $this->loadModel('Bandeconsultations');
        $this->loadModel('Lignebandeconsultations');
        $this->loadModel('Lignelignebandeconsultations');
        $this->loadModel('Projets');
        // debug($id);
        $commandeclient = $this->Demandeoffredeprixes->get($id_dm, [
            'contain' => ['Projets'],
        ]);
        $bandeconsultation = $this->Bandeconsultations->get($id, [
            'contain' => ['Lignebandeconsultations', 'Demandeoffredeprixes']
        ]);
        $ligneas = $this->Lignebandeconsultations->find('all', ['keyfield' => 'id', 'valueField' => 'designiationA'])
            ->group(["nomar" => '(Lignebandeconsultations.designiationA)', "id" => 'Lignebandeconsultations.id'])
            ->where(["Lignebandeconsultations.demandeoffredeprix_id ='" . $id_dm . "'"])->toArray();
        // debug($ligneas);
        // debug($id_dm);
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

        $domainName = $_SERVER['HTTP_HOST'];
        $requestUri = $_SERVER['REQUEST_URI'];
        $segments = explode('/', trim($requestUri, '/')); // Découpe l'URL en segments

        $baseSegment = isset($segments[0]) ? '/' . $segments[0]  : '/';

        $wr = $protocol . $domainName . $baseSegment;
        $lignefr = $this->Lignebandeconsultations->find('all')
            ->where([
                'Lignebandeconsultations.demandeoffredeprix_id' => $id,
                'Lignebandeconsultations.fournisseur_id' => $idfr
            ])
            ->first();
        $fournisseur = $this->Lignebandeconsultations->Fournisseurs->get($idfr, [
            'contain' => []
        ]);
        // debug($fournisseur);
        if ($fournisseur->logo) {
            $logo = str_replace('%20', ' ', $fournisseur->logo);
            $extension = pathinfo($logo, PATHINFO_EXTENSION);
            $extensionWithoutDot = ltrim($extension, '.');
            if ($extensionWithoutDot == 'jpg') {
                $extensionWithoutDot = 'jpeg';
            }
            $img = file_get_contents(
                $wr . '/webroot/img/logofournisseurs/' . $logo . ''
            );

            if ($img !== false) {
                $data = base64_encode($img);
            } else {
                $imggg = file_get_contents(
                    $wr . '/img/logo.png'
                );
                $data = base64_encode($imggg);
                $extensionWithoutDot = 'png';
            }
        } else {
            $imggg = file_get_contents(
                $wr . '/img/logo.png'
            );
            $data = base64_encode($imggg);
            $extensionWithoutDot = 'png';
        }

        //$data = base64_encode($img);
        $img2 = file_get_contents(
            $wr . '/img/SGS.png'
        );

        $data2 = base64_encode($img2);
        $demandes = $this->Bandeconsultations->find()
            ->select(["dm" => '(Bandeconsultations.id)'])
            ->where(["Bandeconsultations.id ='" . $id . "'"])->first();
        // debug($demandes);
        $articles = $this->Articles->find('list', array('fields' => array('Articles.designiation')));
        $clients = $this->fetchTable('Clients')->find('list', ['keyfield' => 'id', 'valueField' => 'nom']);
        $pointdeventes = $this->Commandeclients->Pointdeventes->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $depots = $this->Commandeclients->Depots->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $this->loadModel('Lignecommandeclients');
        $lignecommandeclients = $this->Commandeclients->Lignecommandeclients->find('all')->where(["Lignecommandeclients.commandeclient_id=" . $id . " "]);
        $this->loadModel('Articles');
        $articles = $this->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation']);
        $societes = $this->fetchTable('Societes')->find('all')->first();
        $this->set(compact('data', 'data2', 'extensionWithoutDot', 'fournisseur', 'lignecommandeclients', 'lignefs', 'fournisseurs', 'demandes', 'type', 'articles', 'ligneas', 'societes', 'articles', 'commandeclient', 'clients', 'pointdeventes', 'depots'));
    }
    public function imprimeviewdemande00($id = null, $four_id = null)
    {
        $this->loadModel('Commandeclients');
        $this->loadModel('Bandeconsultations');
        $this->loadModel('Demandeoffredeprixes');
        $this->loadModel('Lignedemandeoffredeprixes');
        $this->loadModel('Articles');
        $this->loadModel('Fournisseurs');
        $this->loadModel('Bandeconsultations');
        $this->loadModel('Lignebandeconsultations');
        $this->loadModel('Lignelignebandeconsultations');
        $this->loadModel('Projets');
        // debug($four_id);
        $four_id = str_replace('%20', ' ', $four_id);
        //var_dump($four_id);

        $demandeoffredeprix = $this->Demandeoffredeprixes->get($id, []);
        $this->loadModel('Lignedemandeoffredeprixes');
        $frss = $this->Lignedemandeoffredeprixes->find('all')
            ->where(['demandeoffredeprix_id' => $id, 'nameF' => $four_id])
            ->toArray();
        $groupedResults = [];
        foreach ($frss as $lignedemandeoffredeprix) {
            $fournisseurId = $lignedemandeoffredeprix->fournisseur_id;
            if (!isset($groupedResults[$four_id])) {
                $groupedResults[$four_id] = [];
            }
            $groupedResults[$four_id][] = $lignedemandeoffredeprix;
        }
        // debug($groupedResults);
        $frs = $this->Lignedemandeoffredeprixes->find('all')->where(["demandeoffredeprix_id=" . $id . ""])
            ->group(["nameF" => '(Lignedemandeoffredeprixes.nameF)'])->toArray();
        $tab1[] = array();
        foreach ($frs as $fr) {
            $four = $fr->nameF;
            // debug($four_id);
            $fr1 = $this->Lignedemandeoffredeprixes->find('all')
                ->where([
                    "nameF" => $four,
                    "demandeoffredeprix_id" => $id

                ])
                ->toArray();
            // debug($fr1);
        }
        $societe = $this->fetchTable('Societes')->find('all')
            ->where(['id' => 1])->first();

        $this->set(compact('demandeoffredeprix', 'societe', 'frss', 'frs', 'fr1', 'tab1', 'groupedResults', 'four_id'));
    }
    public function imprimeviewdemande($id = null, $idfr = null)
    {
        //Configure::write('debug', true);
        debug($idfr);
        $this->loadModel('Commandeclients');
        $this->loadModel('Bandeconsultations');
        $this->loadModel('Demandeoffredeprixes');
        $this->loadModel('Lignedemandeoffredeprixes');
        $this->loadModel('Articles');
        $this->loadModel('Fournisseurs');
        $this->loadModel('Bandeconsultations');
        $this->loadModel('Lignebandeconsultations');
        $this->loadModel('Lignelignebandeconsultations');
        $this->loadModel('Projets');
        // debug($id);
        $commandeclient = $this->Demandeoffredeprixes->get($id, [
            'contain' => ['Projets'],
        ]);
        // $bandeconsultation = $this->Bandeconsultations->get($id, [
        //     'contain' => ['Lignebandeconsultations', 'Demandeoffredeprixes']
        // ]);
        $ligneas = $this->Lignedemandeoffredeprixes->find('all', [
            'keyfield' => 'id',
            'valueField' => 'designiationA'
        ])
            ->group([
                "nomar" => 'Lignedemandeoffredeprixes.designiationA',
                "id" => 'Lignedemandeoffredeprixes.id'
            ])
            ->where([
                "Lignedemandeoffredeprixes.demandeoffredeprix_id =" . $id,
                "Lignedemandeoffredeprixes.fournisseur_id=" . $idfr
            ]);

        // debug($ligneas);
        // debug($id_dm);

        $lignefr = $this->Lignedemandeoffredeprixes->find('all')
            ->where([
                'Lignedemandeoffredeprixes.demandeoffredeprix_id' => $id,
                'Lignedemandeoffredeprixes.fournisseur_id' => $idfr
            ])
            ->first();
        $fournisseur = $this->Lignedemandeoffredeprixes->Fournisseurs->get($idfr, [
            'contain' => []
        ]);
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

        // Récupérer le nom de domaine
        $domainName = $_SERVER['HTTP_HOST'];

        // Récupérer le chemin
        $requestUri = $_SERVER['REQUEST_URI'];
        //debug($requestUri);
        // Construire l'URL complète
        // . $requestUri;

        $segments = explode('/', trim($requestUri, '/')); // Découpe l'URL en segments

        // Récupérer uniquement le premier segment (exemple: "GGB_DEMO")
        $baseSegment = isset($segments[0]) ? '/' . $segments[0]  : '/';

        $wr = $protocol . $domainName . $baseSegment;
        // debug($fournisseur);
        if ($fournisseur->logo) {
            $logo = str_replace('%20', ' ', $fournisseur->logo);
            $extension = pathinfo($logo, PATHINFO_EXTENSION);
            $extensionWithoutDot = ltrim($extension, '.');
            if ($extensionWithoutDot == 'jpg') {
                $extensionWithoutDot = 'jpeg';
            }
            $img = file_get_contents(
                $wr . '/webroot/img/logofournisseurs/' . $logo . ''
            );

            if ($img !== false) {
                $data = base64_encode($img);
            } else {
                $imggg = file_get_contents(
                    $wr . '/img/logo.png'
                );
                $data = base64_encode($imggg);
                $extensionWithoutDot = 'png';
            }
        } else {
            $imggg = file_get_contents(
                $wr . '/img/logo.png'
            );
            $data = base64_encode($imggg);
            $extensionWithoutDot = 'png';
        }

        //$data = base64_encode($img);
        $img2 = file_get_contents(
            $wr . '/img/SGS.png'
        );

        $data2 = base64_encode($img2);
        $demandes = $this->Demandeoffredeprixes->find()
            ->select(["dm" => '(Demandeoffredeprixes.id)'])
            ->where(["Demandeoffredeprixes.id ='" . $id . "'"])->first();
        $dmd = $this->Demandeoffredeprixes->find('All')
            ->where(["Demandeoffredeprixes.id ='" . $id . "'"])->first();
        // debug($demandes);
        $articles = $this->Articles->find('list', array('fields' => array('Articles.designiation')));
        $clients = $this->fetchTable('Clients')->find('list', ['keyfield' => 'id', 'valueField' => 'nom']);
        $pointdeventes = $this->Commandeclients->Pointdeventes->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $depots = $this->Commandeclients->Depots->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $this->loadModel('Lignecommandeclients');
        $lignecommandeclients = $this->Commandeclients->Lignecommandeclients->find('all')->where(["Lignecommandeclients.commandeclient_id=" . $id . " "]);
        $this->loadModel('Articles');
        $articles = $this->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation']);
        $societes = $this->fetchTable('Societes')->find('all')->first();
        $this->set(compact('data', 'data2', 'extensionWithoutDot', 'fournisseur', 'lignecommandeclients', 'dmd', 'lignefs', 'fournisseurs', 'demandes', 'type', 'articles', 'ligneas', 'societes', 'articles', 'commandeclient', 'clients', 'pointdeventes', 'depots'));
    }
    public function imprimeviewdemande0($id = null, $idfr = null)
    {
        //Configure::write('debug', true);
        debug($idfr);
        $this->loadModel('Commandeclients');
        $this->loadModel('Bandeconsultations');
        $this->loadModel('Demandeoffredeprixes');
        $this->loadModel('Lignedemandeoffredeprixes');
        $this->loadModel('Articles');
        $this->loadModel('Fournisseurs');
        $this->loadModel('Bandeconsultations');
        $this->loadModel('Lignebandeconsultations');
        $this->loadModel('Lignelignebandeconsultations');
        $this->loadModel('Projets');
        // debug($id);
        $commandeclient = $this->Demandeoffredeprixes->get($id, [
            'contain' => ['Projets'],
        ]);
        // $bandeconsultation = $this->Bandeconsultations->get($id, [
        //     'contain' => ['Lignebandeconsultations', 'Demandeoffredeprixes']
        // ]);
        $ligneas = $this->Lignedemandeoffredeprixes->find('all', [
            'keyfield' => 'id',
            'valueField' => 'designiationA'
        ])
            ->group([
                "nomar" => 'Lignedemandeoffredeprixes.designiationA',
                "id" => 'Lignedemandeoffredeprixes.id'
            ])
            ->where([
                "Lignedemandeoffredeprixes.demandeoffredeprix_id =" . $id,
                "Lignedemandeoffredeprixes.fournisseur_id=" . $idfr
            ]);

        // debug($ligneas);
        // debug($id_dm);

        $lignefr = $this->Lignedemandeoffredeprixes->find('all')
            ->where([
                'Lignedemandeoffredeprixes.demandeoffredeprix_id' => $id,
                'Lignedemandeoffredeprixes.fournisseur_id' => $idfr
            ])
            ->first();
        $fournisseur = $this->Lignedemandeoffredeprixes->Fournisseurs->get($idfr, [
            'contain' => []
        ]);
        // debug($fournisseur);
        if ($fournisseur->logo) {
            $logo = str_replace('%20', ' ', $fournisseur->logo);
            $extension = pathinfo($logo, PATHINFO_EXTENSION);
            $extensionWithoutDot = ltrim($extension, '.');
            if ($extensionWithoutDot == 'jpg') {
                $extensionWithoutDot = 'jpeg';
            }
            $img = file_get_contents(
                'https://geniusbusiness.isofterp.com/genuis/webroot/img/logofournisseurs/' . $logo . ''
            );

            if ($img !== false) {
                $data = base64_encode($img);
            } else {
                $imggg = file_get_contents(
                    'https://geniusbusiness.isofterp.com/img/logo.png'
                );
                $data = base64_encode($imggg);
                $extensionWithoutDot = 'png';
            }
        } else {
            $imggg = file_get_contents(
                'https://geniusbusiness.isofterp.com/img/logo.png'
            );
            $data = base64_encode($imggg);
            $extensionWithoutDot = 'png';
        }

        //$data = base64_encode($img);
        $img2 = file_get_contents(
            'https://geniusbusiness.isofterp.com/img/SGS.png'
        );

        $data2 = base64_encode($img2);
        $demandes = $this->Demandeoffredeprixes->find()
            ->select(["dm" => '(Demandeoffredeprixes.id)'])
            ->where(["Demandeoffredeprixes.id ='" . $id . "'"])->first();
        $dmd = $this->Demandeoffredeprixes->find('All')
            ->where(["Demandeoffredeprixes.id ='" . $id . "'"])->first();
        // debug($demandes);
        $articles = $this->Articles->find('list', array('fields' => array('Articles.designiation')));
        $clients = $this->fetchTable('Clients')->find('list', ['keyfield' => 'id', 'valueField' => 'nom']);
        $pointdeventes = $this->Commandeclients->Pointdeventes->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $depots = $this->Commandeclients->Depots->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $this->loadModel('Lignecommandeclients');
        $lignecommandeclients = $this->Commandeclients->Lignecommandeclients->find('all')->where(["Lignecommandeclients.commandeclient_id=" . $id . " "]);
        $this->loadModel('Articles');
        $articles = $this->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation']);
        $societes = $this->fetchTable('Societes')->find('all')->first();
        $this->set(compact('data', 'idfr', 'id', 'data2', 'extensionWithoutDot', 'fournisseur', 'lignecommandeclients', 'dmd', 'lignefs', 'fournisseurs', 'demandes', 'type', 'articles', 'ligneas', 'societes', 'articles', 'commandeclient', 'clients', 'pointdeventes', 'depots'));
    }

    public function bandeconsultation($id = null, $project_id = null)
    {
        $this->loadModel('Demandeoffredeprixes');
        $this->loadModel('Lignedemandeoffredeprixes');
        $this->loadModel('Articles');
        $this->loadModel('Fournisseurs');
        $this->loadModel('Bandeconsultations');
        $this->loadModel('Lignebandeconsultations');
        $this->loadModel('Lignelignebandeconsultations');
        $this->loadModel('Commandeclients');
        $this->loadModel('Lignecommandeclients');
        $this->loadModel('Devises');
        $this->loadModel('Conditionreglements');
        $this->loadModel('Methodeexpeditions');
        $this->loadModel('Paiements');


        if (!$this->Demandeoffredeprixes->exists($id)) {
            throw new NotFoundException(__('Invalid demandeoffredeprix'));
        }
        $demandeoffredeprix = $this->Demandeoffredeprixes->get($id, [
            'contain' => ['Lignedemandeoffredeprixes']
        ]);
        $projet = $this->Projets->get($project_id, [
            'contain' => []
        ]);
        // debug($projet);
        $client_id = $projet->client_id;
        $date = date("Y-m-d H:i:s");
        $numeroobj = $this->Commandeclients->find()->select([
            "code" =>
            'MAX(Commandeclients.code)'
        ])->first();
        $numero = $numeroobj->code;
        if ($numero != null) {
            $n = $numero;
            $lastnum = $n;
            $nume = intval($lastnum) + 1;
            $nn = (string) $nume;
            $code = str_pad($nn, 6, "0", STR_PAD_LEFT);
        } else {
            $code = "000001";
        }
        // debug($date);
        if ($this->request->is('post') || $this->request->is('put')) {
            // debug($this->request->getData());
            // die;
            // $datacmd['projet_id'] = $project_id;
            // $datacmd['client_id'] = $client_id;
            // $datacmd['date'] = $date;
            // $commandeclient = $this->fetchTable('Commandeclients')->newEmptyEntity();
            // $commandeclient = $this->Commandeclients->patchEntity($commandeclient, $datacmd);
            // $this->Commandeclients->save($commandeclient);

            $data['demandeoffredeprix_id'] = $this->request->getData()['id'];
            if (isset($this->request->getData('data')['fligne']) && (!empty($this->request->getData('data')['fligne']))) {
                foreach ($this->request->getData('data')['fligne'] as $j => $fourni) {
                    $data['fournisseur_id'] = $fourni['fournisseur_id'];
                    $data['nameF'] = $fourni['nameF'];
                    $data['t'] = $fourni['t'];
                    $data['devise_id'] = $fourni['devise_id'];
                    $data['conditionreglement_id'] = $fourni['conditionreglement_id'];
                    $data['methodeexpedition_id'] = $fourni['methodeexpedition_id'];

                    $totalcmd = 0;
                    // $totalttc = 0;
                    if (isset($this->request->getData('data')['fligne'][$j]['aligne']) && (!empty($this->request->getData('data')['fligne'][$j]['aligne']))) {
                        foreach ($this->request->getData('data')['fligne'][$j]['aligne'] as $i => $art) {
                            $data['article_id'] = $art['article_id'];
                            $data['designiationA'] = $art['designiationA'];
                            $data['qte'] = $art['qte'];
                            $data['prix'] = $art['prix'];
                            $data['totalprix'] = $art['total'];
                            $data['ht'] = $art['total'];
                            // debug($art['total']);
                            $data['lignedemandeoffredeprix_id'] = $art['ligne_id'];
                            $data['codefrs'] = $art['codefrs'];
                            $data['tauxdemarge'] = $art['tauxdemarge'];
                            $data['tauxdemarque'] = $art['tauxdemarque'];
                            $data['coutrevient'] = $art['coutrevient'];
                            $data['datelivraison'] = $art['datelivraison'];

                            //debug($art['coutrevient']);
                            // debug($art['tauxdemarge']);
                            $fichier = $this->request->getData('file');
                            $file = $fichier->getClientFilename();
                            $targetPath = WWW_ROOT . 'img' . DS . $file;
                            if ($file) {
                                $fichier->moveTo($targetPath);
                                $data['fichier'] = $file;
                            }
                            $bande = $this->fetchTable('Bandeconsultations')->newEmptyEntity();
                            $bande = $this->Bandeconsultations->patchEntity($bande, $data);
                            if ($this->Bandeconsultations->save($bande)) {

                                //  debug($bande);
                                $bande_id = ($this->Bandeconsultations->save($bande)->id);
                                $this->misejour("Bandeconsultations", "add", $bande_id);
                                // $projet_id = $bande['projet_id'];
                                // $this->Projet->updateAll(['datemodification' => date('Y-m-d H:i:s')], ['id' => $projet_id]);
                            } else {
                            }
                            // $this->set(compact("bande"));
                            $data['bandeconsultation_id'] = $bande->id;
                            $lignebande = $this->fetchTable('Lignebandeconsultations')->newEmptyEntity();
                            $lignebande = $this->Lignebandeconsultations->patchEntity($lignebande, $data);
                            if ($this->Lignebandeconsultations->save($lignebande)) {

                                //  debug($lignebande);
                                $article = $this->Demandeoffredeprixes->get($id);
                                $article->consultation = '1';
                                $this->Demandeoffredeprixes->save($article);
                                $demande_id = ($this->Demandeoffredeprixes->save($article)->id);
                                $this->misejour("Demandeoffredeprixes", "update", $demande_id);
                            }
                            // $lignecommandeclient = $this->fetchTable('Lignecommandeclients')->newEmptyEntity();
                            // $datacmd['commandeclient_id'] = $commandeclient->id;
                            // $datacmd['article_id'] = $art['article_id'];
                            // $datacmd['qte'] = $art['qte'];
                            // $prixart = $art['prix'];
                            // $tauxdemarge = $art['tauxdemarge'];
                            // $prixclient = $prixart + ($tauxdemarge * $prixart / 100);
                            // $totalcmd += $prixclient;
                            // $datacmd['prixht'] = $prixclient;

                            // $lignecommandeclient = $this->Lignecommandeclients->patchEntity($lignecommandeclient, $datacmd);
                            // if ($this->Lignecommandeclients->save($lignecommandeclient)) {
                            //     $dmd = $this->Demandeoffredeprixes->get($id);
                            //     $dmd->commandeclient = '1';
                            //     $this->Demandeoffredeprixes->save($dmd);
                            // }

                            $this->set(compact("lignebande"));
                        }
                    }
                    // $commandeclient = $this->Commandeclients->get($commandeclient->id, [
                    //     'contain' => []
                    // ]);
                    // $commandeclient->totalht = $totalcmd;
                    // $this->Commandeclients->save($commandeclient);
                    $ligneligne = $this->fetchTable('Lignelignebandeconsultations')->newEmptyEntity();
                    $ligneligne = $this->Lignelignebandeconsultations->patchEntity($ligneligne, $data);
                    if ($this->Lignelignebandeconsultations->save($ligneligne)) {
                        if (isset($fourni['paim']) && (!empty($fourni['paim'])) && ($fourni['paim'] != '')) {
                            $pieces = explode(", ", $fourni['paim']);

                            foreach ($pieces as $key => $piece) {
                                $pp = $this->Paiements->find('all')->where(['Paiements.name ="' . $piece . '"'])->first();
                                $fournisseurpaiement = $this->fetchTable('Fournisseurpaiements')->newEmptyEntity();
                                $dattc['paiement_id'] = $pp['id'];
                                $dattc['lignelignebandeconsultation_id'] = $ligneligne->id;
                                $fournisseurpaiement = $this->fetchTable('Fournisseurpaiements')->patchEntity($fournisseurpaiement, $dattc);
                                $this->fetchTable('Fournisseurpaiements')->save($fournisseurpaiement);
                            }
                        }
                        if (isset($fourni['paiement_id']) && (!empty($fourni['paiement_id'])) && ($fourni['paiement_id'] != '')) {
                            $fournisseurpaiement = $this->fetchTable('Fournisseurpaiements')->newEmptyEntity();
                            $datc['paiement_id'] = $fourni['paiement_id'];
                            $datc['lignelignebandeconsultation_id'] = $ligneligne->id;
                            $fournisseurpaiement = $this->fetchTable('Fournisseurpaiements')->patchEntity($fournisseurpaiement, $datc);
                            $this->fetchTable('Fournisseurpaiements')->save($fournisseurpaiement);
                        }
                    } else {
                    }
                    //$this->set(compact("ligneligne"));
                }
            }

            $this->redirect(array('action' => 'vieww', $project_id));
        } else {
        }

        $lignefs = $this->Lignedemandeoffredeprixes->find('all', ['keyfield' => 'id', 'valueField' => 'nameF'])
            ->group(["nomfour" => '(Lignedemandeoffredeprixes.nameF)'])
            ->where(["Lignedemandeoffredeprixes.demandeoffredeprix_id  ='" . $id . "'"]);
        $fournisseurs = $this->Fournisseurs->find('list');
        $demandes = $this->Demandeoffredeprixes->find()
            ->select(["dm" => '(Demandeoffredeprixes.id)'])
            ->where(["Demandeoffredeprixes.id ='" . $id . "'"])->first();
        $type = $this->Demandeoffredeprixes->find()
            ->select(["typeoffredeprix" => '(Demandeoffredeprixes.typeoffredeprix)'])
            ->where(["Demandeoffredeprixes.id ='" . $id . "'"])->first();
        $typedem = $type['typeoffredeprix'];
        $articles = $this->Articles->find('list', array('fields' => array('Articles.designiation')));
        $ligneas = $this->Lignedemandeoffredeprixes->find('all', ['keyfield' => 'id', 'valueField' => 'designiationA'])
            ->group(["nomar" => '(Lignedemandeoffredeprixes.designiationA)'])
            ->where(["Lignedemandeoffredeprixes.demandeoffredeprix_id =" . $id]);
        $paiements = $this->Paiements->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $devises = $this->Devises->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $conditionreglements = $this->Conditionreglements->find('list', ['keyfield' => 'id', 'valueField' => 'conditionn']);
        $methodeexpeditions = $this->Methodeexpeditions->find('list', ['keyfield' => 'id', 'valueField' => 'methode']);

        $parametretaus = $this->fetchTable('Parametretaus')->find('all')->first();
        $this->set(compact('methodeexpeditions', 'parametretaus', 'conditionreglements', 'devises', 'paiements', 'articles', 'demandes', 'typedem', 'fournisseurs', 'ligneas', 'lignefs', 'demandeoffredeprix', 'project_id'));
    }
    public function addoffreggb($id = null, $dmdid = null, $project_id = null)
    {
        $this->loadModel('Demandeoffredeprixes');
        $this->loadModel('Lignedemandeoffredeprixes');
        $this->loadModel('Articles');
        $this->loadModel('Fournisseurs');
        $this->loadModel('Bandeconsultations');
        $this->loadModel('Lignebandeconsultations');
        $this->loadModel('Lignelignebandeconsultations');
        $this->loadModel('Commandeclients');
        $this->loadModel('Lignecommandeclients');

        $bandeconsultation = $this->Bandeconsultations->get($id, [
            'contain' => ['Lignebandeconsultations', 'Demandeoffredeprixes']
        ]);
        $projet = $this->Projets->get($project_id, [
            'contain' => []
        ]);
        $numeroobj = $this->Commandeclients->find()->select([
            "code" =>
            'MAX(Commandeclients.code)'
        ])->first();
        $numero = $numeroobj->code;
        if ($numero != null) {
            $n = $numero;
            $lastnum = $n;
            $nume = intval($lastnum) + 1;
            $nn = (string) $nume;
            $code = str_pad($nn, 6, "0", STR_PAD_LEFT);
        } else {
            $code = "000001";
        }
        //$lignebandeconsultations = $this->Lignebandeconsultations->find('all')->where(["Lignebandeconsultations.demandeoffredeprix_id  ='" . $dmdid . "'"])->ToArray();
        //      debug($lignebandeconsultations);
        // debug($bandeconsultation);die;
        $client_id = $projet->client_id;
        $date = date("Y-m-d H:i:s");
        $projet_id = $projet->id;
        $datacmd['projet_id'] = $projet_id;
        $datacmd['client_id'] = $client_id;
        $datacmd['code'] = $code;
        $datacmd['date'] = $datacmd['datedecreation'] = $date;
        $datacmd['devisachat_id'] = $bandeconsultation['devise_id'];
        $datacmd['conditionreglement_id'] = $bandeconsultation['conditionreglement_id'];
        $datacmd['methodeexpedition_id'] = $bandeconsultation['methodeexpedition_id'];
        $commandeclient = $this->fetchTable('Commandeclients')->newEmptyEntity();
        $commandeclient = $this->Commandeclients->patchEntity($commandeclient, $datacmd);
        $this->Commandeclients->save($commandeclient);
        $commandeclient_id = $commandeclient->id;
        $lignebandeconsultations = $this->Lignebandeconsultations->find('all')->where(["Lignebandeconsultations.demandeoffredeprix_id  ='" . $dmdid . "'"])->ToArray();
        // debug($lignebandeconsultations);
        $totalttc = 0;
        $totalmarge = 0;
        $totall = 0;
        $totall = 0;
        $totalmarque = 0;
        foreach ($lignebandeconsultations as $ligneb) {
            $lignecommandeclient = $this->fetchTable('Lignecommandeclients')->newEmptyEntity();
            $datacmd['commandeclient_id'] = $commandeclient_id;
            $datacmd['article_id'] = $ligneb->article_id;
            $datacmd['qte'] = $ligneb->qte;
            $datacmd['coutrevient'] = $ligneb->prix;
            if ($datacmd['tauxdemarge']) {
                $totalmarge = 1;
            }
            if ($datacmd['tauxdemarque']) {
                $totalmarque = 1;
            }

            $datacmd['tauxdemarge'] = $ligneb->tauxdemarge;
            $datacmd['tauxdemarque'] = $ligneb->tauxdemarque;
            $datacmd['prixht'] = $ligneb->coutrevient;
            $prixart = $ligneb->prix;
            // debug($ligneb);die;
            $totall = $totall + ($ligneb->prix * $ligneb->qte);
            $totalttc = $totalttc + ($ligneb->coutrevient * $ligneb->qte);
            $punht = $ligneb->coutrevient * $ligneb->qte;
            // $datacmd['punht'] = $punht;
            // $datacmd['ttc'] = $punht;
            $datacmd['punht'] = $ligneb->ht;
            $datacmd['ttc'] = $ligneb->ht;
            $prixclient = $ligneb->coutrevient;
            // debug($prixclient);
            // $marquel = $punht * ($ligneb->tauxdemarque / 100);
            // $margel = $punht * ($ligneb->tauxdemarge / 100);
            // $totalmarque = $totalmarque + $marquel;
            // $totalmarge = $totalmarge + $margel;
            $lignecommandeclient = $this->Lignecommandeclients->patchEntity($lignecommandeclient, $datacmd);
            if ($this->Lignecommandeclients->save($lignecommandeclient)) {
                // debug($lignecommandeclient);die;
                $dmd = $this->Demandeoffredeprixes->get($dmdid);
                $dmd->commandeclient = '1';
                $this->Demandeoffredeprixes->save($dmd);
            }
        }
        // debug($totalttc);die;
        $commandeclient = $this->Commandeclients->get($commandeclient_id, [
            'contain' => []
        ]);
        if ($totalmarge == 1) {
            $totalmarge = $totalttc - $totall;
            $totalmarque = 0;
        }
        if ($totalmarque == 1) {
            $totalmarque = $totalttc - $totall;
            $totalmarge = 0;
        }

        $commandeclient->totalttc = $totalttc;
        $commandeclient->totalht = $totall;
        $commandeclient->tauxdechange = 1;
        $commandeclient->totalfodec = $totalmarque;
        $commandeclient->totalmarge = $totalmarge;
        $this->Commandeclients->save($commandeclient);
        $bandeconsultation = $this->Bandeconsultations->get($id, [
            'contain' => []
        ]);
        $bandeconsultation->offreggb = 1;
        $this->Bandeconsultations->save($bandeconsultation);
        // debug($bandeconsultation);
        //$this->redirect(array('action' => 'vieww', $project_id, $commandeclient_id));
        $this->redirect(array('action' => 'editcomcli', $commandeclient_id));

        $this->set(compact('articles', 'demandes', 'typedem', 'fournisseurs', 'demandeoffredeprix', 'project_id'));
    }
    public function bandeconsultationtest($id = null, $project_id = null)
    {
        $this->loadModel('Demandeoffredeprixes');
        $this->loadModel('Lignedemandeoffredeprixes');
        $this->loadModel('Articles');
        $this->loadModel('Fournisseurs');
        $this->loadModel('Bandeconsultations');
        $this->loadModel('Lignebandeconsultations');
        $this->loadModel('Lignelignebandeconsultations');
        $this->loadModel('Commandeclients');
        $this->loadModel('Lignecommandeclients');
        if (!$this->Demandeoffredeprixes->exists($id)) {
            throw new NotFoundException(__('Invalid demandeoffredeprix'));
        }
        $demandeoffredeprix = $this->Demandeoffredeprixes->get($id, [
            'contain' => ['Lignedemandeoffredeprixes']
        ]);
        $projet = $this->Projets->get($project_id, [
            'contain' => []
        ]);
        // debug($projet);
        $client_id = $projet->client_id;
        $date = date("Y-m-d H:i:s");
        // debug($date);
        if ($this->request->is('post') || $this->request->is('put')) {
            $datacmd['projet_id'] = $project_id;
            $datacmd['client_id'] = $client_id;
            $datacmd['date'] = $date;
            $commandeclient = $this->fetchTable('Commandeclients')->newEmptyEntity();
            $commandeclient = $this->Commandeclients->patchEntity($commandeclient, $datacmd);
            $this->Commandeclients->save($commandeclient);
            //debug($this->request->getData());die;
            $data['demandeoffredeprix_id'] = $this->request->getData()['id'];
            if (isset($this->request->getData('data')['fligne']) && (!empty($this->request->getData('data')['fligne']))) {
                foreach ($this->request->getData('data')['fligne'] as $j => $fourni) {
                    $data['fournisseur_id'] = $fourni['fournisseur_id'];
                    $data['nameF'] = $fourni['nameF'];
                    $data['t'] = $fourni['t'];
                    $totalcmd = 0;
                    if (isset($this->request->getData('data')['fligne'][$j]['aligne']) && (!empty($this->request->getData('data')['fligne'][$j]['aligne']))) {
                        foreach ($this->request->getData('data')['fligne'][$j]['aligne'] as $i => $art) {
                            $data['article_id'] = $art['article_id'];
                            $data['designiationA'] = $art['designiationA'];
                            $data['qte'] = $art['qte'];
                            $data['prix'] = $art['prix'];
                            $data['totalprix'] = $art['total'];
                            $data['ht'] = $art['total'];
                            $data['lignedemandeoffredeprix_id'] = $art['ligne_id'];
                            $data['codefrs'] = $art['codefrs'];
                            // debug($art['tauxdemarge']);

                            $bande = $this->fetchTable('Bandeconsultations')->newEmptyEntity();
                            $bande = $this->Bandeconsultations->patchEntity($bande, $data);
                            if ($this->Bandeconsultations->save($bande)) {
                                $bande_id = ($this->Bandeconsultations->save($bande)->id);
                                $this->misejour("Bandeconsultations", "add", $bande_id);

                                // $projet_id = $bande['projet_id'];
                                // $this->Projet->updateAll(['datemodification' => date('Y-m-d H:i:s')], ['id' => $projet_id]);
                            } else {
                            }
                            // $this->set(compact("bande"));
                            $data['bandeconsultation_id'] = $bande->id;
                            $lignebande = $this->fetchTable('Lignebandeconsultations')->newEmptyEntity();
                            $lignebande = $this->Lignebandeconsultations->patchEntity($lignebande, $data);
                            if ($this->Lignebandeconsultations->save($lignebande)) {
                                $article = $this->Demandeoffredeprixes->get($id);
                                $article->consultation = '1';
                                $this->Demandeoffredeprixes->save($article);
                                $demande_id = ($this->Demandeoffredeprixes->save($article)->id);
                                $this->misejour("Demandeoffredeprixes", "update", $demande_id);
                            }
                            $lignecommandeclient = $this->fetchTable('Lignecommandeclients')->newEmptyEntity();
                            $datacmd['commandeclient_id'] = $commandeclient->id;
                            $datacmd['article_id'] = $art['article_id'];
                            $datacmd['qte'] = $art['qte'];
                            $prixart = $art['prix'];
                            $tauxdemarge = $art['tauxdemarge'];
                            $prixclient = $prixart + ($tauxdemarge * $prixart / 100);
                            $totalcmd += $prixclient;
                            $datacmd['prixht'] = $prixclient;

                            $lignecommandeclient = $this->Lignecommandeclients->patchEntity($lignecommandeclient, $datacmd);
                            if ($this->Lignecommandeclients->save($lignecommandeclient)) {
                                $dmd = $this->Demandeoffredeprixes->get($id);
                                $dmd->commandeclient = '1';
                                $this->Demandeoffredeprixes->save($dmd);
                            }
                            $this->set(compact("lignebande"));
                        }
                    }
                    $ligneligne = $this->fetchTable('Lignelignebandeconsultations')->newEmptyEntity();
                    $ligneligne = $this->Lignelignebandeconsultations->patchEntity($ligneligne, $data);
                    if ($this->Lignelignebandeconsultations->save($ligneligne)) {
                    } else {
                    }
                    //$this->set(compact("ligneligne"));
                }
                $commandeclient = $this->Commandeclients->get($commandeclient->id, [
                    'contain' => []
                ]);
                $commandeclient->totalht = $totalcmd;
                $this->Commandeclients->save($commandeclient);

                // $demandeoffredeprix->consultation = 1;
                // $demandeoffredeprix->commandeclient = 1;
                // debug($demandeoffredeprix);
                // $this->Demandeoffredeprix->save($demandeoffredeprix);
            }

            $this->redirect(array('action' => 'vieww', $project_id));
        } else {
        }

        $lignefs = $this->Lignedemandeoffredeprixes->find('all', ['keyfield' => 'id', 'valueField' => 'nameF'])
            ->group(["nomfour" => '(Lignedemandeoffredeprixes.nameF)'])
            ->where(["Lignedemandeoffredeprixes.demandeoffredeprix_id  ='" . $id . "'"]);
        $fournisseurs = $this->Fournisseurs->find('list');
        $demandes = $this->Demandeoffredeprixes->find()
            ->select(["dm" => '(Demandeoffredeprixes.id)'])
            ->where(["Demandeoffredeprixes.id ='" . $id . "'"])->first();
        $type = $this->Demandeoffredeprixes->find()
            ->select(["typeoffredeprix" => '(Demandeoffredeprixes.typeoffredeprix)'])
            ->where(["Demandeoffredeprixes.id ='" . $id . "'"])->first();
        $typedem = $type['typeoffredeprix'];
        $articles = $this->Articles->find('list', array('fields' => array('Articles.designiation')));
        $ligneas = $this->Lignedemandeoffredeprixes->find('all', ['keyfield' => 'id', 'valueField' => 'designiationA'])
            ->group(["nomar" => '(Lignedemandeoffredeprixes.designiationA)'])
            ->where(["Lignedemandeoffredeprixes.demandeoffredeprix_id =" . $id]);

        $this->set(compact('articles', 'demandes', 'typedem', 'fournisseurs', 'ligneas', 'lignefs', 'demandeoffredeprix', 'project_id'));
    }
    public function bandeconsultation070324($id = null, $project_id = null)
    {
        $this->loadModel('Demandeoffredeprixes');
        $this->loadModel('Lignedemandeoffredeprixes');
        $this->loadModel('Articles');
        $this->loadModel('Fournisseurs');
        $this->loadModel('Bandeconsultations');
        $this->loadModel('Lignebandeconsultations');
        $this->loadModel('Lignelignebandeconsultations');
        if (!$this->Demandeoffredeprixes->exists($id)) {
            throw new NotFoundException(__('Invalid demandeoffredeprix'));
        }
        $demandeoffredeprix = $this->Demandeoffredeprixes->get($id, [
            'contain' => ['Lignedemandeoffredeprixes']
        ]);
        if ($this->request->is('post') || $this->request->is('put')) {
            //debug($this->request->getData());die;
            $data['demandeoffredeprix_id'] = $this->request->getData()['id'];
            if (isset($this->request->getData('data')['fligne']) && (!empty($this->request->getData('data')['fligne']))) {
                foreach ($this->request->getData('data')['fligne'] as $j => $fourni) {
                    $data['fournisseur_id'] = $fourni['fournisseur_id'];
                    $data['nameF'] = $fourni['nameF'];
                    $data['t'] = $fourni['t'];
                    if (isset($this->request->getData('data')['fligne'][$j]['aligne']) && (!empty($this->request->getData('data')['fligne'][$j]['aligne']))) {
                        foreach ($this->request->getData('data')['fligne'][$j]['aligne'] as $i => $art) {
                            $data['article_id'] = $art['article_id'];
                            $data['designiationA'] = $art['designiationA'];
                            $data['qte'] = $art['qte'];
                            $data['prix'] = $art['prix'];
                            $data['totalprix'] = $art['total'];
                            $data['ht'] = $art['total'];
                            $data['lignedemandeoffredeprix_id'] = $art['ligne_id'];
                            $data['codefrs'] = $art['codefrs'];
                            $bande = $this->fetchTable('Bandeconsultations')->newEmptyEntity();
                            $bande = $this->Bandeconsultations->patchEntity($bande, $data);
                            if ($this->Bandeconsultations->save($bande)) {
                                $bande_id = ($this->Bandeconsultations->save($bande)->id);
                                $this->misejour("Bandeconsultations", "add", $bande_id);
                                // $projet_id = $bande['projet_id'];
                                // $this->Projet->updateAll(['datemodification' => date('Y-m-d H:i:s')], ['id' => $projet_id]);
                            } else {
                            }
                            // $this->set(compact("bande"));
                            $data['bandeconsultation_id'] = $bande->id;
                            $lignebande = $this->fetchTable('Lignebandeconsultations')->newEmptyEntity();
                            $lignebande = $this->Lignebandeconsultations->patchEntity($lignebande, $data);
                            if ($this->Lignebandeconsultations->save($lignebande)) {
                                $article = $this->Demandeoffredeprixes->get($id);
                                $article->consultation = '1';
                                $this->Demandeoffredeprixes->save($article);
                                $demande_id = ($this->Demandeoffredeprixes->save($article)->id);
                                $this->misejour("Demandeoffredeprixes", "update", $demande_id);
                            } else {
                            }
                            // $this->set(compact("lignebande"));
                        }
                    }
                    $ligneligne = $this->fetchTable('Lignelignebandeconsultations')->newEmptyEntity();
                    $ligneligne = $this->Lignelignebandeconsultations->patchEntity($ligneligne, $data);
                    if ($this->Lignelignebandeconsultations->save($ligneligne)) {
                    } else {
                    }
                    //$this->set(compact("ligneligne"));
                }
            }
            $this->redirect(array('action' => 'etatcomparatif', $id, $project_id));
        } else {
        }

        $lignefs = $this->Lignedemandeoffredeprixes->find('all', ['keyfield' => 'id', 'valueField' => 'nameF'])
            ->group(["nomfour" => '(Lignedemandeoffredeprixes.nameF)'])
            ->where(["Lignedemandeoffredeprixes.demandeoffredeprix_id  ='" . $id . "'"]);
        $fournisseurs = $this->Fournisseurs->find('list');
        $demandes = $this->Demandeoffredeprixes->find()
            ->select(["dm" => '(Demandeoffredeprixes.id)'])
            ->where(["Demandeoffredeprixes.id ='" . $id . "'"])->first();
        $type = $this->Demandeoffredeprixes->find()
            ->select(["typeoffredeprix" => '(Demandeoffredeprixes.typeoffredeprix)'])
            ->where(["Demandeoffredeprixes.id ='" . $id . "'"])->first();
        $typedem = $type['typeoffredeprix'];
        $articles = $this->Articles->find('list', array('fields' => array('Articles.designiation')));
        $ligneas = $this->Lignedemandeoffredeprixes->find('all', ['keyfield' => 'id', 'valueField' => 'designiationA'])
            ->group(["nomar" => '(Lignedemandeoffredeprixes.designiationA)'])
            ->where(["Lignedemandeoffredeprixes.demandeoffredeprix_id =" . $id]);

        $this->set(compact('articles', 'demandes', 'typedem', 'fournisseurs', 'ligneas', 'lignefs', 'demandeoffredeprix', 'project_id'));
    }
    public function viewconsultation($id = null, $id_dm = null)
    {
        // debug($id_dm);
        error_reporting(E_ERROR | E_PARSE);
        $this->loadModel('Demandeoffredeprixes');
        $this->loadModel('Lignedemandeoffredeprixes');
        $this->loadModel('Articles');
        $this->loadModel('Fournisseurs');
        $this->loadModel('Bandeconsultations');
        $this->loadModel('Lignebandeconsultations');
        $this->loadModel('Lignelignebandeconsultations');
        $bandeconsultation = $this->Bandeconsultations->get($id, [
            'contain' => ['Lignebandeconsultations', 'Demandeoffredeprixes']
        ]);

        $ligneas = $this->Lignebandeconsultations->find('all', ['keyfield' => 'id', 'valueField' => 'designiationA'])
            ->group(["nomar" => '(Lignebandeconsultations.designiationA)', "id" => 'Lignebandeconsultations.id'])
            ->where(["Lignebandeconsultations.bandeconsultation_id ='" . $id . "'"])->toArray();
        // debug($ligneas);
        // debug($id_dm);
        $lignefs = $this->Lignebandeconsultations->find('all', ['keyfield' => 'id', 'valueField' => 'nameF'])
            ->group(["nomfour" => '(Lignebandeconsultations.nameF)'])
            ->where(["Lignebandeconsultations.bandeconsultation_id  ='" . $id . "'"])->toArray();
        // debug($lignefs);
        $fournisseurs = $this->Fournisseurs->find('list');
        $demandes = $this->Bandeconsultations->find()
            ->select(["dm" => '(Bandeconsultations.id)'])
            ->where(["Bandeconsultations.id ='" . $id . "'"])->first();
        // debug($demandes);
        $articles = $this->Articles->find('list', array('fields' => array('Articles.designiation')));
        $this->set(compact('id_dm', 'articles', 'demandes', 'fournisseurs', 'ligneas', 'lignefs', 'bandeconsultation', 'typeof'));
    }

    public function duplicate($id = null, $project_id = null)
    {
        $this->loadModel('Commandeclients');
        $this->loadModel('Personnels');
        $this->loadModel('Lignecommandeclients');
        $commandeclient = $this->Commandeclients->get($id, [
            'contain' => ['Lignecommandeclients'],
        ]);
        $numeroobj = $this->Commandeclients->find()->select([
            "numerox" =>
            'MAX(Commandeclients.code)'
        ])->first();
        $numero = $numeroobj->numerox;
        if ($numero != null) {
            $n = $numero;
            $lastnum = $n;
            $nume = intval($lastnum) + 1;
            $nn = (string) $nume;
            $code = str_pad($nn, 6, "0", STR_PAD_LEFT);
        } else {
            $code = "000001";
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            $commandeclients = $this->Commandeclients->newEmptyEntity();
            $commandeclients['code'] = $code;
            //$commandeclients['commandeclient_id'] = $commandeclient->commandeclient_id;
            // debug($this->request->getData());
            $commandeclients['commandeclient_id'] = $id;
            $commandeclients = $this->Commandeclients->patchEntity($commandeclients, $this->request->getData(), ['associated' => ['Lignecommandeclients' => ['validate' => false]]]);
            if ($this->Commandeclients->save($commandeclients)) {
                // debug($commandeclients);
                $this->misejour("Offre ggb", "duplicate", $id);
                $commandeclient_id = $commandeclients->id;
                $this->misejour("Offre ggb", "add", $commandeclient_id);
                if (isset($this->request->getData('data')['lignecommandeclients']) && (!empty($this->request->getData('data')['lignecommandeclients']))) {
                    // debug($this->request->getData('data')['lignecommandeclients']);
                    foreach ($this->request->getData('data')['lignecommandeclients'] as $i => $res) {
                        if ($res['sup0'] != 1) {
                            $dat['fournisseur_id'] = $res['fournisseur_id'];

                            $dat['article_id'] = $res['article_id'];
                            $dat['qte'] = $res['qte'];
                            $dat['prixht'] = $res['prixht'];
                            // $dat['remise'] = $res['remise'];
                            $dat['punht'] = $res['punht'];

                            $dat['tauxdemarge'] = $res['tauxdemarge'];
                            $dat['tauxdemarque'] = $res['tauxdemarque'];
                            $dat['coutrevient'] = $res['coutrevient'];
                            $dat['tva'] = $res['tva'];
                            $dat['type'] = $res['type'];
                            $dat['fodec'] = $res['fodec'];
                            $dat['ttc'] = $res['ttc'];
                            $dat['commandeclient_id'] = $commandeclient_id;

                            $dat['typeremise_id'] = (int) $res['typeremise_id'];
                            if ($res['typeremise_id'] == 1) {
                                $dat['remise'] = $res['remise'];
                                $dat['remiseval'] = 0;
                            } else if ($res['typeremise_id'] == 2) {
                                $dat['remiseval'] = $res['remiseval'];
                                $dat['remise'] = 0;
                            }
                            $lignecommandeclient = $this->fetchTable('lignecommandeclients')->newEmptyEntity();
                            $lignecommandeclient = $this->fetchTable('lignecommandeclients')->patchEntity($lignecommandeclient, $dat);
                            // debug($lignecommandeclient);die;
                            if ($this->fetchTable('lignecommandeclients')->save($lignecommandeclient)) {
                            } else {
                            }
                        }
                        $this->set(compact("lignecommandeclient"));
                    }
                }
                return $this->redirect(['action' => 'vieww/', $project_id]);
            }
        }
        $this->loadModel('Clients');
        $this->loadModel('Projets');
        $projets = $this->fetchTable('Projets')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $clients = $this->fetchTable('Clients')->find('list', ['keyfield' => 'id', 'valueField' => 'nom']);
        $chauffeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 5 . "%' "]);
        $convoyeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 1 . "%' "]);
        $pointdeventes = $this->Commandeclients->Pointdeventes->find('list', ['limit' => 200]);
        $depots = $this->Commandeclients->Depots->find('list', ['limit' => 200]);
        $cartecarburants = $this->Commandeclients->Cartecarburants->find('list', ['limit' => 200]);
        $materieltransports = $this->Commandeclients->Materieltransports->find('list', ['limit' => 200]);
        $bonlivraisons = $this->Commandeclients->Bonlivraisons->find('list', ['limit' => 200]);
        $this->loadModel('Lignecommandeclients');
        // $lignecommandeclients = $this->Commandeclients->Lignecommandeclients->find('all')->where(["Lignecommandeclients.commandeclient_id=" . $id . " "])->ToArray();
        // debug($id);
        $connection = ConnectionManager::get('default');
        // $lignecommandeclients = $connection->execute("SELECT lc.* FROM lignecommandeclients lc INNER JOIN ( SELECT article_id, MAX(prixht) AS max_price FROM lignecommandeclients WHERE lignecommandeclients.type=1 and commandeclient_id='" . $id . "' GROUP BY article_id) AS max_prices ON lc.article_id = max_prices.article_id AND lc.prixht = max_prices.max_price WHERE lc.commandeclient_id='" . $id . "'")->fetchAll('assoc');
        // $lignecommandeclient2s = $connection->execute("SELECT lc.* FROM lignecommandeclients lc INNER JOIN ( SELECT article_id, MAX(prixht) AS max_price FROM lignecommandeclients WHERE lignecommandeclients.type=2 and  commandeclient_id='" . $id . "' GROUP BY article_id) AS max_prices ON lc.article_id = max_prices.article_id AND lc.prixht = max_prices.max_price WHERE lc.commandeclient_id='" . $id . "'")->fetchAll('assoc');

        $lignecommandeclients = $this->Commandeclients->Lignecommandeclients->find('all')->where(["Lignecommandeclients.commandeclient_id=" . $id, "Lignecommandeclients.type=1"]);
        $lignecommandeclient2s = $this->Commandeclients->Lignecommandeclients->find('all')->where(["Lignecommandeclients.commandeclient_id=" . $id, "Lignecommandeclients.type=2"]);
        //debug($commandeclient);

        $this->loadModel('Articles');

        $articles = $this->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Articles.typearticle = 1"]);

        // $devises = $this->fetchTable('Devises')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $devises = $this->fetchTable('Devises')->find('list', [
            'keyfield' => 'id',
            'valueField' => function ($d) {
                return $d->name . ' (' . $d->symbole . ')';
            }
        ]);
        $incoterms = $this->fetchTable('Incoterms')->find('list', ['keyfield' => 'id', 'valueField' => 'code']);
        $connection = ConnectionManager::get('default');
        $code = '-1';

        if ($commandeclient['devis_id']) {
            $devise = $connection->execute("SELECT code FROM devises WHERE id='" . $commandeclient['devis_id'] . "'")->fetch('assoc');
            // debug($devise);die;
            $code = $devise['code'];
        }
        $incotermpdfs = $this->fetchTable('Incoterms')->find('list', ['keyfield' => 'id', 'valueField' => 'code']);
        $this->loadModel('Paiements');
        $paiements = $this->Paiements->find('list', ['keyfield' => 'id', 'valueField' => 'name']);


        if ($commandeclient['paiement_id']) {
            $gg = explode(" ", $commandeclient['paiement_id']);
        }

        $Clientpaiement = $this->fetchTable('Clientpaiements')->find('all')->where('Clientpaiements.commandeclient_id =' . $id);
        $gg = [];
        foreach ($Clientpaiement as $itemm) {

            array_push($gg, $itemm['paiement_id']);
        }
        $pays = $this->fetchTable('Pays')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        //debug($gg) ;
        $modetransports = $this->fetchTable('Modetransports')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        // debug($lignecommandeclients);die;
        $unites = $this->fetchTable('Unites')->find('all');
        //debug($articles->toArray());
        $this->loadModel('Fournisseurs');

        $articleservises = $this->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Articles.typearticle = 2"]);
        $conditionreglements = $this->fetchTable('Conditionreglements')->find('list', ['keyfield' => 'id', 'valueField' => 'conditionn']);
        $delailivraisons = $this->fetchTable('Delailivraisons')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $methodeexpeditions = $this->fetchTable('Methodeexpeditions')->find('list', ['keyfield' => 'id', 'valueField' => 'methode']);
        $fournisseurs = $this->Fournisseurs->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        if ($commandeclient['banque_id']) {
            $comptesBanks = $this->fetchtable('ComptesBank')->find('all')->where(['ComptesBank.banque_id' => $commandeclient['banque_id']]);
            //debug($comptesBanks->toArray());
        }
        $banques = $this->fetchTable('Banques')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $parametretaus = $this->fetchTable('Parametretaus')->find('all')->first();
        $typeremises['1'] = "%";
        $typeremises['2'] = "Valeur";
        $this->set(compact('comptesBanks', 'parametretaus', 'typeremises', 'banques', 'fournisseurs', 'methodeexpeditions', 'delailivraisons', 'conditionreglements', 'articleservises', 'lignecommandeclient2s', 'unites', 'project_id', 'gg', 'modetransports', 'pays', 'paiements', 'incotermpdfs', 'devises', 'incoterms', 'code', 'lignecommandeclients', 'articles', 'commandeclient', 'clients', 'projets', 'depots', 'cartecarburants', 'materieltransports', 'chauffeurs', 'convoyeurs', 'bonlivraisons'));
    }
    public function etatcomparatif1($id = null, $project_id = null)
    {
        $this->loadModel('Demandeoffredeprixes');
        $this->loadModel('Lignedemandeoffredeprixes');
        $this->loadModel('Articles');
        $this->loadModel('Fournisseurs');
        $this->loadModel('Commandefournisseurs');
        $this->loadModel('Lignecommandefournisseurs');
        $this->loadModel('Fournisseurs');
        $this->loadModel('Lignedemandeoffredeprixes');
        $this->loadModel('Bandeconsultations');
        $this->loadModel('Lignebandeconsultations');
        $this->loadModel('Lignelignebandeconsultations');
        $this->loadModel('Articlefournisseurs');
        $this->loadModel('Projets');
        $demandes = $this->Demandeoffredeprixes->find()
            ->select(["dm" => '(Demandeoffredeprixes.id)'])
            ->where(["Demandeoffredeprixes.id  ='" . $id . "'"])->first();
        $type = $this->Demandeoffredeprixes->find()
            ->select(["typeoffredeprix" => '(Demandeoffredeprixes.typeoffredeprix)'])
            ->where(["Demandeoffredeprixes.id ='" . $id . "'"])->first();
        $projet = $this->Demandeoffredeprixes->find()
            ->select(["projet" => '(Demandeoffredeprixes.projet_id)'])
            ->where(["Demandeoffredeprixes.id ='" . $id . "'"])->first();
        $typedem = $type['typeoffredeprix'];

        $pp = $projet['projet'];
        $date = $this->Demandeoffredeprixes->find()
            ->select(["date" => '(Demandeoffredeprixes.date)'])
            ->where(["Demandeoffredeprixes.id ='" . $id . "'"])->first();
        $commande = $this->Commandefournisseurs->newEmptyEntity();
        $num = $this->Commandefournisseurs->find()->select([
            "numcmd" =>
            'MAX(Commandefournisseurs.numero)'
        ])->first();
        $numero = $num->numcmd;
        $n = $numero;
        if (!empty($n)) {
            $ff = intval(substr($n, 3, 7)) + 1;
            $d = str_pad("$ff", 5, '0', STR_PAD_LEFT);
            $c = str_pad("$d", 6, 'C', STR_PAD_LEFT);
        } else {
            $n = "00001";
            $c = str_pad("$n", 6, 'C', STR_PAD_LEFT);
        }
        if ($this->request->is('post') || $this->request->is('put')) {

            $comd = $this->fetchTable('Commandefournisseurs')->newEmptyEntity();
            $data['demandeoffredeprix_id'] = $id;
            $data['projet_id'] = $this->request->getData('projet_id');
            $data['numero'] = $this->request->getData('numero');
            $data['date'] = $this->request->getData('date');
            $comd = $this->Commandefournisseurs->patchEntity($comd, $data);
            if ($this->Commandefournisseurs->save($comd)) {
                $validechamp = $this->fetchTable('Projets')->find('all')->where('Projets.id = ' . $projet->projet)->first();
                $validechamp->valide = 1;
                $this->Projets->save($validechamp);
                if (isset($this->request->getData('data')['fligne']) && (!empty($this->request->getData('data')['fligne']))) {
                    foreach ($this->request->getData('data')['fligne'] as $j => $fourni) {
                        if (!empty($fourni['check'])) {
                            if ($fourni['check'] == 1) {
                                $data['numero'] = $this->request->getData('numero');
                                $data['t'] = $fourni['t'];
                                $data['name'] = $fourni['nameF'];
                                $data['date'] = date('d-m-y');
                                if (!$fourni['id']) {
                                    $dat = $this->fetchTable('Fournisseurs')->newEmptyEntity();
                                    $dat['name'] = $fourni['nameF'];
                                    if ($this->Fournisseurs->save($dat)) {
                                        $fournisseur_id = ($this->Fournisseurs->save($dat)->id);
                                        $this->misejour("Fournisseurs", "add", $fournisseur_id);
                                        $fournisseur_id = $dat->id;
                                        $data['fournisseur_id'] = $fournisseur_id;
                                    }
                                } else {
                                    $data['fournisseur_id'] = $fourni['id'];
                                }
                            }
                        }
                    }
                }
            }
            if (isset($this->request->getData('data')['lignefourn']) && (!empty($this->request->getData('data')['lignefourn']))) {
                foreach ($this->request->getData('data')['lignefourn'] as $j => $fourniss) {
                    $datx = $this->fetchTable('Commandefournisseurs')->newEmptyEntity();
                    $num = $this->Commandefournisseurs->find()->select([
                        "numdepot" =>
                        'MAX(Commandefournisseurs.numero)'
                    ])->first();
                    $numero = $num->numdepot;
                    $n = 0;
                    $n = $numero;
                    if (!empty($n)) {
                        $ff = intval(substr($n, 3, 7)) + 1;
                        $z = str_pad("$ff", 5, '0', STR_PAD_LEFT);
                        $b = str_pad("$z", 6, 'C', STR_PAD_LEFT);
                    } else {
                        $n = "C00001";
                        $z = str_pad(" $n", 5, '0', STR_PAD_LEFT);
                        $b = str_pad("$z", 6, 'C', STR_PAD_LEFT);
                    }
                    if (!empty($fourniss['c'])) {
                        if ($fourniss['c'] == 1) {
                            $data['numero'] = $this->request->getData('numero');
                            $data['name'] = $fourniss['nameF'];
                            $data['date'] = date('d-m-y');
                            if (!$fourniss['id']) {
                                $data = $this->fetchTable('Fournisseurs')->newEmptyEntity();
                                $data['name'] = $fourniss['nameF'];
                                if ($this->Fournisseurs->save($data)) {
                                    $frs_id = ($this->Fournisseurs->save($data)->id);
                                    $this->misejour("Fournisseurs", "add", $frs_id);
                                    $fournisseur_id = $data->id;
                                    $data['fournisseur_id'] = $fournisseur_id;
                                    $datx['fournisseur_id'] = $fournisseur_id;
                                    $dattt['fournisseur_id'] = $fournisseur_id;
                                }
                            } else {
                                $data['fournisseur_id'] = $fourniss['id'];
                                $datx['fournisseur_id'] = $fourniss['id'];
                                $dattt['fournisseur_id'] = $fourniss['id'];
                            }
                            $datx['numero'] = $b;
                            $datx['date'] = date('y-m-d');
                            $datx['projet_id'] = $data['numero'] = $this->request->getData('projet_id');;
                            $datx['demandeoffredeprix_id'] = $id;
                            if ($this->Commandefournisseurs->save($datx)) {
                                $cmd_id = ($this->Commandefournisseurs->save($datx)->id);
                                $this->misejour("Commandefournisseurs", "add", $cmd_id);
                                $comd_id = $datx['id'];
                                if (isset($this->request->getData('data')['lignefourn'][$j]['ligneart']) && (!empty($this->request->getData('data')['lignefourn'][$j]['ligneart']))) {
                                    foreach ($this->request->getData('data')['lignefourn'][$j]['ligneart'] as $i => $arti) {
                                        $datz = $this->fetchTable('Articles')->newEmptyEntity();
                                        $dattt = $this->fetchTable('Lignecommandefournisseurs')->newEmptyEntity();
                                        if ($arti['check2']) {
                                            $data['date'] = $this->request->getData('date');
                                            $lbc = $this->Lignebandeconsultations->find()->where(["Lignebandeconsultations.id = '" . $arti['ligne_id'] . "' "])->first();
                                            $data['designiation'] = $arti['designiationA'];
                                            if (!$arti['article_id']) {
                                                $datz['Dsignation'] = $arti['designiationA'];
                                                $datz['typearticle_id'] = 2;
                                                if ($this->Articles->save($datz)) {
                                                    $article_id = ($this->Articles->save($datz)->id);
                                                    $this->misejour("Articles", "add", $article_id);
                                                    $data['article_id'] = $ar['id'];
                                                    $data['article_id'] = $datz['id'];
                                                    $dattt['article_id'] = $datz['id'];
                                                }
                                            } else {
                                                $data['article_id'] = $arti['article_id'];
                                                $dattt['article_id'] = $arti['article_id'];
                                            }
                                            $data['code'] = $lbc['codefrs'];
                                            $data['prix'] = $arti['prix'];
                                            $dattt['codefrs'] = $lbc['codefrs'];
                                            $dattt['qte'] = $arti['qte'];
                                            $dattt['prix'] = $arti['prix'];
                                            $dattt['ht'] = $arti['ht'];
                                            $dattt['commandefournisseur_id'] = $comd_id;
                                            if ($this->Lignecommandefournisseurs->save($dattt)) {
                                                $article = $this->Demandeoffredeprixes->get($id);
                                                $article->commande = '1';
                                                $this->Demandeoffredeprixes->save($article);
                                                $dmd_id = ($this->Demandeoffredeprixes->save($article)->id);
                                                $this->misejour("Demandeoffredeprixes", "update", $dmd_id);
                                            } else {
                                                $this->Flash->error("Failed to create Lignecommandefournisseurs offre de prix");
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
            $this->redirect(array('action' => 'vieww/', $project_id));
        }
        $fournisseurs = $this->Lignelignebandeconsultations->find('all', ['keyfield' => 'id', 'valueField' => 'nameF'])
            ->group(["namef" => '(Lignelignebandeconsultations.nameF)'])
            ->where(["Lignelignebandeconsultations.demandeoffredeprix_id  ='" . $id . "'"]);
        $articles = $this->Bandeconsultations->find('all', ['keyfield' => 'id', 'valueField' => 'designiationA'])
            ->group(["art" => '(Bandeconsultations.designiationA)'])
            ->where(["Bandeconsultations.demandeoffredeprix_id = '" . $id . "'"]);
        $tab = array();
        $tab1 = array();
        foreach ($fournisseurs as $frs) {
            $idfrs = $frs['fournisseur_id'];
            $namefrs = $frs['nameF'];
            foreach ($articles as $art) {
                $idart = $art['article_id'];
                $iddemande = $art['demandeoffredeprix_id'];
                $artdes = $art['designiationA'];
                $donnes = $this->Lignebandeconsultations->find()
                    ->where(["Lignebandeconsultations.nameF = '" . $namefrs . "'"])
                    ->where(["Lignebandeconsultations.demandeoffredeprix_id  = '" . $iddemande . "'"])
                    ->where(["Lignebandeconsultations.designiationA = '" . $artdes . "'"]);
                $pr = $this->Lignebandeconsultations->find('all')
                    ->select(["ht" => '(Lignebandeconsultations.ht)'])
                    ->where(["Lignebandeconsultations.demandeoffredeprix_id = '" . $iddemande . "'"])
                    ->where(["Lignebandeconsultations.designiationA = '" . $artdes . "'"])
                    ->order(["Lignebandeconsultations.ht"]);
                $tab[$idfrs][$idart] = $donnes;
                $tab1[$idfrs][$idart] = $pr;
            }
        }
        $lignefs = $this->Lignelignebandeconsultations->find('all')
            ->group(["nomfour" => '(Lignelignebandeconsultations.nameF)'])
            ->where(["Lignelignebandeconsultations.demandeoffredeprix_id = '" . $id . "'"])
            ->order(["Lignelignebandeconsultations.t"]);
        $d = array();
        $o = 0;
        foreach ($lignefs as $o => $lf) {
            $ligneas = $this->Lignebandeconsultations->find('all', ['keyfield' => 'id', 'valueField' => 'designiationA'])
                ->group(["nomar" => '(Lignebandeconsultations.designiationA)'])
                ->where(["Lignebandeconsultations.demandeoffredeprix_id ='" . $id . "'"])
                ->where(["Lignebandeconsultations.nameF  ='" . $lf['nameF'] . "'"]);
            $n = 0;
            foreach ($ligneas as $n => $la) {
                $d[$o][$n] = $la;
            }
        }
        $this->loadModel('Projets');
        $projets = $this->fetchTable('Projets')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $this->set(compact('project_id', 'tab', 'pp', 'projets', 'typedem', 'tab1', 'fournisseurs', 'd', 'demandes', 'c', 'articles', 'commande', 'date', 'lignefs', 'ligneas'));
    }
    public function etatcomparatif($id = null, $project_id = null)
    {
        $this->loadModel('Demandeoffredeprixes');
        $this->loadModel('Lignedemandeoffredeprixes');
        $this->loadModel('Articles');
        $this->loadModel('Fournisseurs');
        $this->loadModel('Commandefournisseurs');
        $this->loadModel('Lignecommandefournisseurs');
        $this->loadModel('Fournisseurs');
        $this->loadModel('Lignedemandeoffredeprixes');
        $this->loadModel('Bandeconsultations');
        $this->loadModel('Lignebandeconsultations');
        $this->loadModel('Lignelignebandeconsultations');
        $this->loadModel('Articlefournisseurs');
        $this->loadModel('Projets');
        $this->loadModel('Paiements');

        $demandes = $this->Demandeoffredeprixes->find()
            ->select(["dm" => '(Demandeoffredeprixes.id)'])
            ->where(["Demandeoffredeprixes.id  ='" . $id . "'"])->first();
        $type = $this->Demandeoffredeprixes->find()
            ->select(["typeoffredeprix" => '(Demandeoffredeprixes.typeoffredeprix)'])
            ->where(["Demandeoffredeprixes.id ='" . $id . "'"])->first();
        $projet = $this->Demandeoffredeprixes->find()
            ->select(["projet" => '(Demandeoffredeprixes.projet_id)'])
            ->where(["Demandeoffredeprixes.id ='" . $id . "'"])->first();
        $typedem = $type['typeoffredeprix'];

        $pp = $projet['projet'];
        $date = $this->Demandeoffredeprixes->find()
            ->select(["date" => '(Demandeoffredeprixes.date)'])
            ->where(["Demandeoffredeprixes.id ='" . $id . "'"])->first();
        $commande = $this->Commandefournisseurs->newEmptyEntity();
        $num = $this->Commandefournisseurs->find()->select([
            "numcmd" =>
            'MAX(Commandefournisseurs.numero)'
        ])->first();
        $numero = $num->numcmd;
        $n = $numero;
        if (!empty($n)) {
            $ff = intval(substr($n, 3, 7)) + 1;
            $d = str_pad("$ff", 5, '0', STR_PAD_LEFT);
            $c = str_pad("$d", 6, 'C', STR_PAD_LEFT);
        } else {
            $n = "00001";
            $c = str_pad("$n", 6, 'C', STR_PAD_LEFT);
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            $totalttc = 0;
            // debug($this->request->getData());die;
            // $comd = $this->fetchTable('Commandefournisseurs')->newEmptyEntity();

            // $comd = $this->Commandefournisseurs->patchEntity($comd, $data);
            if (isset($this->request->getData('data')['fligne']) && (!empty($this->request->getData('data')['fligne']))) {
                foreach ($this->request->getData('data')['fligne'] as $j => $fourni) {
                    //debug($fourni);

                    if (!empty($fourni['check'])) {
                        if ($fourni['check'] == 1) {
                            $data['numero'] = $this->request->getData('numero');
                            $data['t'] = $fourni['t'];
                            $data['name'] = $fourni['nameF'];
                            $data['nameF'] = $fourni['nameF'];
                            $data['devise_id'] = $fourni['devise_id'];
                            $data['conditionreglement_id'] = $fourni['conditionreglement_id'];
                            $data['methodeexpedition_id'] = $fourni['methodeexpedition_id'];
                            $data['date'] = date('Y-m-d');
                            //debug($data);die;
                            if (!$fourni['id']) {
                                //debug("pas d'id");
                                $dat = $this->fetchTable('Fournisseurs')->newEmptyEntity();
                                $dat['name'] = $fourni['nameF'];
                                if ($this->Fournisseurs->save($dat)) {
                                    $fournisseur_id = ($this->Fournisseurs->save($dat)->id);
                                    $this->misejour("Fournisseurs", "add", $fournisseur_id);

                                    $fournisseur_id = $dat->id;
                                    $data['fournisseur_id'] = $fournisseur_id;
                                    // $dataligne['fournisseur_id'] =$fournisseur_id;
                                }
                            } else {
                                $data['fournisseur_id'] = $fourni['id'];
                                //$dataligne['fournisseur_id'] = $fourni['id'];
                            }
                            $data['demandeoffredeprix_id'] = $id;
                            // debug($data);die;
                            $data['type'] = 1;
                            $comd = $this->fetchTable('Commandefournisseurs')->newEmptyEntity();
                            $data['demandeoffredeprix_id'] = $id;
                            // $data['projet_id'] = $this->request->getData('projet_id');
                            $data['projet_id'] = $project_id;
                            // $data['numero'] = $this->request->getData('numero');
                            $data['date'] = $this->request->getData('date');

                            $comd = $this->Commandefournisseurs->patchEntity($comd, $data);
                            // debug($data);
                            if ($this->Commandefournisseurs->save($comd)) {
                                // debug($comd);
                                $comd_id = ($this->Commandefournisseurs->save($comd)->id);
                                if (isset($fourni['paim']) && (!empty($fourni['paim'])) && ($fourni['paim'] != '')) {
                                    $pieces = explode(", ", $fourni['paim']);

                                    foreach ($pieces as $key => $piece) {
                                        $pp = $this->Paiements->find('all')->where(['Paiements.name ="' . $piece . '"'])->first();
                                        if (!empty($pp)) {
                                            $fournisseurpaiement = $this->fetchTable('Fournisseurpaiementcommandes')->newEmptyEntity();
                                            $dattc['paiement_id'] = $pp['id'];
                                            $dattc['fournisseur_id'] = $data['fournisseur_id'];
                                            $dattc['commandefournisseur_id'] = $comd_id;
                                            $fournisseurpaiement = $this->fetchTable('Fournisseurpaiementcommandes')->patchEntity($fournisseurpaiement, $dattc);
                                            $this->fetchTable('Fournisseurpaiementcommandes')->save($fournisseurpaiement);
                                        }
                                    }
                                }
                                $this->misejour("Commandefournisseurs", "add", $comd_id);

                                $comd_id = $comd['id'];
                                if (isset($this->request->getData('data')['fligne'][$j]['aligne']) && (!empty($this->request->getData('data')['fligne'][$j]['aligne']))) {

                                    foreach ($this->request->getData('data')['fligne'][$j]['aligne'] as $i => $art) {
                                        $dataligne = $this->fetchTable('Lignecommandefournisseurs')->newEmptyEntity();

                                        $lbc = $this->Lignebandeconsultations->find()->where(["Lignebandeconsultations.id =  '" . $art['ligne_id'] . "' "])->first();
                                        $data['designiation'] = $art['designiationA'];
                                        $dataligne['designiationA'] = $art['designiationA'];
                                        if (!$art['id']) {
                                            $datta = $this->fetchTable('Articles')->newEmptyEntity();
                                            $datta['Dsignation'] = $art['designiationA'];
                                            $datta['famille_id'] = 12;
                                            $datta['typearticle_id'] = 2;

                                            if ($this->fetchTable('Articles')->save($datta)) {
                                                $article_id = $datta['id'];
                                                $data['article_id'] = $article_id;
                                                $dataligne['article_id'] = $article_id;
                                            }
                                        } else {
                                            $data['article_id'] = $art['id'];
                                            $dataligne['article_id'] = $art['id'];
                                        }
                                        $data['code'] = $lbc['codefrs'];
                                        $data['prix'] = $art['prix'];
                                        $artfr = $this->fetchTable('Articlefournisseurs')->newEmptyEntity();
                                        $artfr = $this->Articlefournisseurs->patchEntity($artfr, $data);
                                        if ($this->Articlefournisseurs->save($artfr)) {
                                            $artfrs_id = ($this->Articlefournisseurs->save($artfr)->id);
                                            $this->misejour("Articlefournisseurs", "add", $artfrs_id);
                                        } else {
                                            $this->Flash->error("Failed to create Articlefournisseurs offre de prix");
                                        }


                                        $dataligne['codefrs'] = $lbc['codefrs'];
                                        $dataligne['qte'] = $art['qte'];
                                        $dataligne['prix'] = $art['prix'];
                                        $dataligne['ht'] = $art['ht'];
                                        $dataligne['ttc'] = $art['ht'];
                                        $totalttc += $art['ht'];
                                        debug($totalttc);
                                        // debug($art['ht']);
                                        $dataligne['commandefournisseur_id'] = $comd_id;
                                        //   debug($dataligne);
                                        if ($this->Lignecommandefournisseurs->save($dataligne)) {
                                            // debug($dataligne);
                                            // $lignebc = $this->Lignebandeconsultations->find('all')->where(["Lignebandeconsultations.id = '" . $art['ligne_id'] . "' "]);
                                            $lignebc = $this->Lignebandeconsultations->find('all')
                                                ->where(["Lignebandeconsultations.id = '" . $art['ligne_id'] . "'"])->toArray();
                                            foreach ($lignebc as $lbc) {
                                                $lbc->valide = 1;
                                                $this->Lignebandeconsultations->save($lbc);
                                            }



                                            $article = $this->Demandeoffredeprixes->get($id);
                                            $article->commande = '1';
                                            //                                                debug($article);

                                            $this->Demandeoffredeprixes->save($article);
                                            $dmd_id = ($this->Demandeoffredeprixes->save($article)->id);
                                            $this->misejour("Demandeoffredeprixes", "update", $dmd_id);
                                        }
                                    }
                                    // debug($totalttc);
                                    $comfour = $this->Commandefournisseurs->find('all')
                                        ->where(["id  ='" . $comd_id . "'"])->first();
                                    $comfour->ttc = $comfour->ht = $totalttc;
                                    $this->Commandefournisseurs->save($comfour);
                                    // debug($comfour);
                                }

                                //debug($comd_id);
                                // $this->Flash->success("Commande has been created successfully");
                            }
                        }
                    }
                }
            }
            if (isset($this->request->getData('data')['lignefourn']) && (!empty($this->request->getData('data')['lignefourn']))) {
                foreach ($this->request->getData('data')['lignefourn'] as $j => $fourniss) {
                    $datxx = $this->fetchTable('Commandefournisseurs')->newEmptyEntity();




                    $num = $this->Commandefournisseurs->find()->select([
                        "numdepot" =>
                        'MAX(Commandefournisseurs.numero)'
                    ])->first();
                    $numero = $num->numdepot;
                    // debug($numero);die;

                    // C00030

                    $n = 0;
                    $n = $numero;

                    if (!empty($n)) {
                        $ff = intval(substr($n, 3, 7)) + 1;
                        $z = str_pad("$ff", 5, '0', STR_PAD_LEFT);
                        $b = str_pad("$z", 6, 'C', STR_PAD_LEFT);
                        //debug($b);
                    } else {
                        $n = "C00001";
                        $z = str_pad(" $n", 5, '0', STR_PAD_LEFT);
                        $b = str_pad("$z", 6, 'C', STR_PAD_LEFT);
                    }



                    if (!empty($fourniss['c'])) {
                        if ($fourniss['c'] == 1) {
                            $data['numero'] = $this->request->getData('numero');

                            $data['name'] = $fourniss['nameF'];
                            $data['date'] = date('Y-m-d');
                            $datx['nameF'] = $fourniss['nameF'];
                            if (!$fourniss['id']) {
                                $data = $this->fetchTable('Fournisseurs')->newEmptyEntity();
                                $data['name'] = $fourniss['nameF'];

                                if ($this->Fournisseurs->save($data)) {
                                    $frs_id = ($this->Fournisseurs->save($data)->id);
                                    $this->misejour("Fournisseurs", "add", $frs_id);

                                    $fournisseur_id = $data->id;
                                    $data['fournisseur_id'] = $fournisseur_id;
                                    $datx['fournisseur_id'] = $fournisseur_id;
                                    $dattt['fournisseur_id'] = $fournisseur_id;
                                }
                            } else {
                                $data['fournisseur_id'] = $fourniss['id'];
                                $datx['fournisseur_id'] = $fourniss['id'];
                                $dattt['fournisseur_id'] = $fourniss['id'];
                            }


                            $datx['numero'] = $b;
                            $datx['date'] = date('Y-m-d');
                            $datx['demandeoffredeprix_id'] = $id;
                            $datx['type'] = 2;
                            $datx['projet_id'] = $project_id;
                            // debug($this->request->getData('projet_id'));
                            $datxx = $this->Commandefournisseurs->patchEntity($datxx, $datx);
                            if ($this->Commandefournisseurs->save($datxx)) {
                                // debug($datxx);
                                $cmd_id = ($this->Commandefournisseurs->save($datxx)->id);
                                if (isset($fourniss['paim']) && (!empty($fourniss['paim'])) && ($fourniss['paim'] != '')) {
                                    $pieces = explode(", ", $fourniss['paim']);

                                    foreach ($pieces as $key => $piece) {
                                        $pp = $this->Paiements->find('all')->where(['Paiements.name ="' . $piece . '"'])->first();
                                        $fournisseurpaiement = $this->fetchTable('Fournisseurpaiementcommandes')->newEmptyEntity();
                                        $dattcc['paiement_id'] = $pp['id'];
                                        $dattcc['fournisseur_id'] = $datx['fournisseur_id'];
                                        $dattcc['commandefournisseur_id'] = $cmd_id;
                                        $fournisseurpaiement = $this->fetchTable('Fournisseurpaiementcommandes')->patchEntity($fournisseurpaiement, $dattcc);
                                        $this->fetchTable('Fournisseurpaiementcommandes')->save($fournisseurpaiement);
                                    }
                                }
                                $this->misejour("Commandefournisseurs", "add", $cmd_id);

                                $comd_id = $datxx['id'];


                                if (isset($this->request->getData('data')['lignefourn'][$j]['ligneart']) && (!empty($this->request->getData('data')['lignefourn'][$j]['ligneart']))) {
                                    foreach ($this->request->getData('data')['lignefourn'][$j]['ligneart'] as $i => $arti) {
                                        $datz = $this->fetchTable('Articles')->newEmptyEntity();
                                        $dattt = $this->fetchTable('Lignecommandefournisseurs')->newEmptyEntity();
                                        //debug($arti['check2']);die;
                                        if ($arti['check2']) {

                                            $data['date'] = $this->request->getData('date');
                                            $lbc = $this->Lignebandeconsultations->find()->where(["Lignebandeconsultations.designiationA = '" . $arti['designiationA'] . "' ", "Lignebandeconsultations.demandeoffredeprix_id = '" . $id . "' "])->first();

                                            $lbc = $this->Lignebandeconsultations->find()->where(["Lignebandeconsultations.id = '" . $arti['ligne_id'] . "' "])->first();
                                            $lbcc = $this->Lignebandeconsultations->find('all')->where(["Lignebandeconsultations.designiationA = '" . $arti['designiationA'] . "' ", "Lignebandeconsultations.demandeoffredeprix_id = '" . $id . "' "]);

                                            foreach ($lbcc as $lbcom) {

                                                // $lbcc = $this->Lignebandeconsultations->find()->where(["Lignebandeconsultations.id = '" . $lbcom['id'] . "' "])->first();

                                                // if ($lbcom->id == $arti['ligne_id']) {
                                                $lbcom->valide = 1;
                                                //debug($lbcom);die;
                                                $this->Lignebandeconsultations->save($lbcom);
                                                // }

                                            }
                                            $data['designiation'] = $arti['designiationA'];
                                            $dattt['designiationA'] = $art['designiationA'];
                                            if (!$arti['article_id']) {

                                                $datz['Dsignation'] = $arti['designiationA'];
                                                $datz['typearticle_id'] = 2;
                                                $datz['famille_id'] = 12;
                                                // debug($datz);
                                                if ($this->Articles->save($datz)) {
                                                    $article_id = ($this->Articles->save($datz)->id);
                                                    $this->misejour("Articles", "add", $article_id);
                                                    $data['article_id'] = $datz['id'];
                                                    $data['article_id'] = $datz['id'];
                                                    $dattt['article_id'] = $datz['id'];
                                                }
                                            } else {
                                                $data['article_id'] = $arti['article_id'];
                                                $dattt['article_id'] = $arti['article_id'];
                                            }
                                            $data['code'] = $lbc['codefrs'];
                                            $data['prix'] = $arti['prix'];


                                            $dattt['codefrs'] = $lbc['codefrs'];
                                            $dattt['qte'] = $arti['qte'];
                                            $dattt['prix'] = $arti['prix'];
                                            $dattt['ht'] = $arti['ht'];
                                            $dattt['ttc'] = $arti['ht'];
                                            $totalttc += $arti['ht'];
                                            $dattt['commandefournisseur_id'] = $comd_id;
                                            // debug($dattt);
                                            // $data['numero'] = $this->request->getData('mm');

                                            if ($this->Lignecommandefournisseurs->save($dattt)) {
                                                //debug($dattt);die;
                                                $lignebcc = $this->Lignebandeconsultations->find()
                                                    ->where(['Lignebandeconsultations.demandeoffredeprix_id' => $id, 'Lignebandeconsultations.article_id' => $arti['article_id']])
                                                    ->toArray();
                                                // debug($arti['ligne_id']);
                                                // foreach ($lignebcc as $lbcom) {
                                                //     if ($lbcom->id == $arti['ligne_id']) {
                                                //         $lbcom->valide = 1;
                                                //     }
                                                //     $this->Lignebandeconsultations->save($lbcom);
                                                // }


                                                // $lignebc = $this->Lignebandeconsultations->find()->where(["Lignebandeconsultations.id = '" . $arti['ligne_id'] . "' "])->first();
                                                // $lignebc->valide = 1;
                                                // $this->Lignebandeconsultations->save($lignebc);


                                                $article = $this->Demandeoffredeprixes->get($id);
                                                $article->commande = '1';
                                                //debug($article);
                                                $this->Demandeoffredeprixes->save($article);
                                                $dmd_id = ($this->Demandeoffredeprixes->save($article)->id);
                                                $this->misejour("Demandeoffredeprixes", "update", $dmd_id);
                                            } else {
                                                $this->Flash->error("Failed to create Lignecommandefournisseurs offre de prix");
                                            }
                                        }
                                    }
                                    $comfour = $this->Commandefournisseurs->find('all')
                                        ->where(["id  ='" . $comd_id . "'"])->first();
                                    $comfour->ttc = $comfour->ht = $totalttc;
                                    $this->Commandefournisseurs->save($comfour);
                                }
                            }
                        }
                    }
                }
            }

            $this->redirect(array('action' => 'vieww/', $project_id));
        }

        $fournisseurs = $this->Lignelignebandeconsultations->find('all', ['keyfield' => 'id', 'valueField' => 'nameF'])
            ->group(["namef" => '(Lignelignebandeconsultations.nameF)'])
            ->where(["Lignelignebandeconsultations.demandeoffredeprix_id  ='" . $id . "'"]);
        $articles = $this->Bandeconsultations->find('all', ['keyfield' => 'id', 'valueField' => 'designiationA'])
            ->group(["art" => '(Bandeconsultations.designiationA)'])
            ->where(["Bandeconsultations.demandeoffredeprix_id = '" . $id . "'"]);
        $tab = array();
        $tab1 = array();
        foreach ($fournisseurs as $frs) {
            $idfrs = $frs['fournisseur_id'];
            $namefrs = $frs['nameF'];
            foreach ($articles as $art) {
                $idart = $art['article_id'];
                $iddemande = $art['demandeoffredeprix_id'];
                $artdes = $art['designiationA'];
                $donnes = $this->Lignebandeconsultations->find()
                    ->where(["Lignebandeconsultations.nameF = '" . $namefrs . "'"])
                    ->where(["Lignebandeconsultations.demandeoffredeprix_id  = '" . $iddemande . "'"])
                    ->where(["Lignebandeconsultations.designiationA = '" . $artdes . "'"]);
                $pr = $this->Lignebandeconsultations->find('all')
                    ->select(["ht" => '(Lignebandeconsultations.ht)'])
                    ->where(["Lignebandeconsultations.demandeoffredeprix_id = '" . $iddemande . "'"])
                    ->where(["Lignebandeconsultations.designiationA = '" . $artdes . "'"])
                    ->order(["Lignebandeconsultations.ht"]);
                $tab[$idfrs][$idart] = $donnes;
                $tab1[$idfrs][$idart] = $pr;
            }
        }
        $lignefs = $this->Lignelignebandeconsultations->find('all')
            ->group(["nomfour" => '(Lignelignebandeconsultations.nameF)'])
            ->where(["Lignelignebandeconsultations.demandeoffredeprix_id = '" . $id . "'"])
            ->order(["Lignelignebandeconsultations.t"]);
        $d = array();
        $o = 0;
        foreach ($lignefs as $o => $lf) {
            $ligneas = $this->Lignebandeconsultations->find('all', ['keyfield' => 'id', 'valueField' => 'designiationA'])
                ->group(["nomar" => '(Lignebandeconsultations.designiationA)'])
                ->where(["Lignebandeconsultations.demandeoffredeprix_id ='" . $id . "'"])
                ->where(["Lignebandeconsultations.nameF  ='" . $lf['nameF'] . "'"]);
            $n = 0;
            foreach ($ligneas as $n => $la) {
                $d[$o][$n] = $la;
            }
        }
        $this->loadModel('Projets');
        $this->loadModel('Paiements');
        $this->loadModel('Devises');
        $this->loadModel('Conditionreglements');
        $this->loadModel('Methodeexpeditions');
        $projets = $this->fetchTable('Projets')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $paiements = $this->Paiements->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $devises = $this->Devises->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $conditionreglements = $this->Conditionreglements->find('list', ['keyfield' => 'id', 'valueField' => 'conditionn']);
        $methodeexpeditions = $this->Methodeexpeditions->find('list', ['keyfield' => 'id', 'valueField' => 'methode']);
        $this->set(compact('paiements', 'devises', 'conditionreglements', 'methodeexpeditions', 'project_id', 'tab', 'pp', 'projets', 'typedem', 'tab1', 'fournisseurs', 'd', 'demandes', 'c', 'articles', 'commande', 'date', 'lignefs', 'ligneas'));
    }
    public function getdevise($devise_id = null)
    {
        $projet_id = $this->request->getQuery('projet_id');
        $connection = ConnectionManager::get('default');
        $devise_id = $this->request->getQuery('devise_id');
        $devisachat_id = $this->request->getQuery('devisachat_id');
        debug($devise_id);

        if ($projet_id != null) {
            //$pro = $connection->execute("SELECT devises.code FROM projets,devises WHERE projets.id=" . $projet_id . " and devises.id=projets.devise_id ")->fetch('assoc');
            //  debug($pro);//die;
            //$query = $this->fetchTable('Devises')->find('all')->where('id =' . $devise_id);
            $pro = $connection->execute("SELECT code FROM devises WHERE id='" . $devisachat_id . "'")->fetch('assoc');
            $devise = $connection->execute("SELECT code FROM devises WHERE id='" . $devise_id . "'")->fetch('assoc');
            $code = $devise['code'];
            debug($code); //die;
            debug($pro['code']);
            //$content = file_get_contents("https://api.devises.zone/v1/quotes/" . $devise['code'] . "/" . $pro['code'] . "/json?quantity=1&key=52660|one7uLPwKe6xmkTXt74n");
            $content = file_get_contents("https://cdn.taux.live/api/latest.json");

            debug($content); //die;

            $result = json_decode($content);
            debug($result->rates); //die;

            //debug($devise['code']);die; 
            debug(str_replace("'", "", $devise['code'])); //die;
            // $dev=EUR;
            // debug($result->rates->EUR);die;

            //  print_r($result->rates->{$devise['code']});die;
            if ($pro['code']) {
                // print_r($pro['code']);
                // print_r($devise['code']);
                $dp = $result->rates->{$pro['code']};
                $dv = $result->rates->{$devise['code']};

                $taux = (float) $dv / (float) $dp;
                $taux = sprintf("%01.4f", $taux);
            } else {
                $taux = 0;
            }


            // if($pro['code']=='USD'){
            //     $taux = $result->$devise['code'];
            // }
            // else{
            //     $taux = 1/$result->$devise['code'];
            // }

            //   debug($taux);die;

            //   debug($taux);die;
        } else {
            $devise = $connection->execute("SELECT code FROM devises WHERE id='" . $devise_id . "'")->fetch('assoc');
            $code = $devise['code'];
            $taux = 0;
        }
        //debug($taux);
        echo json_encode(array('code' => $code, 'codeachat' => $pro['code'], 'taux' => $taux));
        exit;
    }
    public function validation($id = null)
    {

        //debug($type);

        $this->paginate = [
            'contain' => ['Demandeoffredeprixes', 'Articles', 'Fournisseurs'],
        ];
        $this->loadModel('Commandefournisseurs');
        $this->loadModel('Lignecommandefournisseurs');
        $this->loadModel('Fournisseurs');
        $this->loadModel('Pointdeventes');
        $this->loadModel('Lignecommandefournisseurs');
        $this->loadModel('Depots');
        $this->loadModel('Devises');
        $commande = $this->Commandefournisseurs->get($id, [
            'contain' => []
        ]);

        // debug($commande);
        $this->loadModel('Demandeoffredeprixes');
        if (!$this->Commandefournisseurs->exists($id)) {
            throw new NotFoundException(__('Invalid commande'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            $data['devise_id'] = $this->request->getData('devise_id');
            $data['incoterm_id'] = $this->request->getData('incoterm_id');
            $data['dateprev'] = $this->request->getData('dateprev');
            $data['tauxdechange'] = $this->request->getData('tauxdechange');

            $commande = $this->Commandefournisseurs->patchEntity($commande, $data);
            // debug($commande);

            if ($this->Commandefournisseurs->save($commande)) {
                debug($commande);

                $projet_id = $commande['projet_id'];
                // debug($projet_id);die;
                $cmd_id = ($this->Commandefournisseurs->save($commande)->id);
                $this->misejour("Commandefournisseurs", "Validation", $cmd_id);
                $lignecmd = $this->Lignecommandefournisseurs->find('all', [])
                    ->where(["Lignecommandefournisseurs.commandefournisseur_id  ='" . $id . "'"]);
                foreach ($lignecmd as $c) {
                    $this->Commandefournisseurs->Lignecommandefournisseurs->delete($c);
                }
                if (isset($this->request->getData('data')['ligner']) && (!empty($this->request->getData('data')['ligner']))) {
                    $this->loadModel('Commandefournisseurs');
                    foreach ($this->request->getData('data')['ligner'] as $i => $commande) {
                        if ($commande['sup0'] != 1) {
                            $data['commandefournisseur_id'] = $cmd_id;
                            $data['fournisseur_id'] = $this->request->getData('fournisseur_id');
                            $data['date'] = date('d-m-y');
                            $data['qte'] = $commande['qte'];
                            $data['prix'] = $commande['prix'];
                            $data['ht'] = $commande['punht'];
                            $data['article_id'] = $commande['article_id'];
                            $data['remise'] = $commande['remise'];
                            $data['fodec'] = $commande['fodec'];
                            $data['tva'] = $commande['tva'];
                            $data['ttc'] = $commande['ttc'];
                            $cd = $this->fetchTable('Lignecommandefournisseurs')->newEmptyEntity();
                            $cd = $this->Lignecommandefournisseurs->patchEntity($cd, $data);
                            if ($this->Lignecommandefournisseurs->save($cd)) {
                            } else {
                            }
                            $this->set(compact("cd"));
                        }
                    }
                }

                $commande = $this->Commandefournisseurs->get($id);
                $commande->valide = '1';
                $commande->remise = $this->request->getData('remise');
                $commande->ttc = $this->request->getData('ttc');
                $commande->ht = $this->request->getData('ht');
                $commande->devise_id = $this->request->getData('devise_id');
                $this->Commandefournisseurs->save($commande);
                //  debug($commande);
                $projet = $this->Projets->get($projet_id);
                $datetimeActuelle = FrozenTime::now();
                $datetimeActuelle->format('Y-m-d H:i:s');
                $projet->datemodification = $datetimeActuelle;
                $this->Projets->save($projet);

                return $this->redirect(['action' => 'vieww/', $projet_id]);
            }
        }
        $lignecommandes = $this->Commandefournisseurs->Lignecommandefournisseurs->find('all', [
            'contain' => ['Articles']
        ])
            ->where(['commandefournisseur_id' => $id]);
        $demandeoffredeprixes = $this->Commandefournisseurs->Demandeoffredeprixes->find('list', ['limit' => 200]);
        $depots = $this->Commandefournisseurs->Depots->find('list', ['limit' => 200]);
        $cartecarburants = $this->Commandefournisseurs->Cartecarburants->find('list', ['limit' => 200]);
        $materieltransports = $this->Commandefournisseurs->Materieltransports->find('list', ['limit' => 200]);
        $articles = $this->Commandefournisseurs->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation']);
        $this->loadModel('Conteneurs');
        $conteneur = $this->fetchTable('Conteneurs')->find('list', ['keyfield' => 'id', 'valueField' => 'Identifiant']);
        $this->loadModel('Fournisseurs');
        $this->loadModel('Projets');
        $projets = $this->fetchTable('Projets')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        // $devises = $this->fetchTable('Devises')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $devises = $this->fetchTable('Devises')->find('list', [
            'keyfield' => 'id',
            'valueField' => function ($d) {
                return $d->name . ' (' . $d->symbole . ')';
            }
        ]);

        $incoterms = $this->fetchTable('Incoterms')->find('list', ['keyfield' => 'id', 'valueField' => 'code']);
        $fournisseurs = $this->fetchTable('Fournisseurs')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $this->set(compact('projet_id', 'devises', 'incoterms', 'conteneur', 'commande', 'lignecommandes', 'projets', 'articles', 'demandeoffredeprixes', 'fournisseurs', 'depots', 'cartecarburants', 'materieltransports', 'type'));
    }
    public function addindregfour($project_id = null, $four = null, $fac = null)
    {
        $this->loadModel('Reglements');
        $this->loadModel('Factures');
        $this->loadModel('Projets');

        $this->loadModel('Livraisons');
        $this->loadModel('Lignereglements');
        $this->loadModel('Piecereglements');
        $reglement = $this->Reglements->newEmptyEntity();
        if ($this->request->is('post')) {
            $data['numeroconca'] = $this->request->getData('numeroconca');
            $data['Date'] = $this->request->getData('Date');
            $data['fournisseur_id'] = $this->request->getData('fournisseur_id');
            $data['projet_id'] = $project_id;
            $data['pointdevente_id'] = $this->request->getData('pointdevente_id');
            $data['Montant'] = $this->request->getData('data')['Reglement']['Montant'];
            $reglement = $this->Reglements->patchEntity($reglement, $data);
            if ($this->Reglements->save($reglement)) {
                $projet_id = $reglement['projet_id'];
                $this->loadModel('Projets');
                $projet = $this->Projets->get($projet_id);
                $datetimeActuelle = FrozenTime::now();
                $datetimeActuelle->format('Y-m-d H:i:s');
                $projet->datemodification = $datetimeActuelle;
                $this->Projets->save($projet);
                $reglement_id = $reglement->id;
                if (isset($this->request->getData('data')['Lignereglement']) && (!empty($this->request->getData('data')['Lignereglement']))) {
                    foreach ($this->request->getData('data')['Lignereglement'] as $i => $l) {
                        if (isset($l['facture_id'])) {
                            $ta = $this->fetchTable('Lignereglements')->newEmptyEntity();
                            $ta['reglement_id'] = $reglement_id;
                            $ta['facture_id'] = $l['facture_id'];
                            $ta['Montant'] = $l['Montanttt'];
                            $mtg = $this->Factures->find()->select([
                                "mtreg" =>
                                'Factures.Montant_Regler'
                            ])->where(['Factures.id =' . $l['facture_id']])->first();
                            $MontantRegler = $mtg->mtreg;
                            $fact = $this->Factures->get($l['facture_id']);
                            $fact->Montant_Regler = $MontantRegler + $l['Montanttt'];
                            $this->Factures->save($fact);
                            $this->fetchTable('Lignereglements')->save($ta);
                        }
                        $facture = $this->Factures->find("All")->where(['Factures.projet_id =' . $project_id, 'Factures.id' => $fac])->first();
                        $facture->valide = 1;
                        $this->Factures->save($facture);
                    }
                }
            }
            if (isset($this->request->getData('data')['pieceregelemnt']) && (!empty($this->request->getData('data')['pieceregelemnt']))) {
                foreach ($this->request->getData('data')['pieceregelemnt'] as $j => $p) {
                    if (isset($p['sup']) && $p['sup'] != 1) {
                        $tab = $this->fetchTable('Piecereglements')->newEmptyEntity();
                        $tab['reglement_id'] = $reglement_id;
                        $tab['paiement_id'] = $p['paiement_id'];
                        $tab['banque_id'] = $p['banque_id'];
                        $tab['montant'] = $p['montant'];
                        $tab['to_id'] = $p['taux'];
                        $tab['montant_net'] = $p['montantnet'];
                        $tab['echance'] = $p['echance'];
                        $tab['carnetcheque_id'] = $p['carnetcheque_id'];
                        $tab['num'] = $p['num_piece'];

                        $this->fetchTable('Piecereglements')->save($tab);
                    }
                }
            }
            return $this->redirect(['action' => 'vieww/', $project_id]);
        }
        $factures = '';

        if ($four != null && $fac != null) {
            $this->loadModel('Factures');
            $factures = $this->Factures->find('all')->where(['Factures.projet_id =' . $project_id, 'Factures.id' => $fac, 'Factures.ttc > Factures.Montant_Regler']);
        }

        $numeroobj = $this->Reglements->find()->select([
            "numerox" =>
            'MAX(Reglements.numeroconca)'
        ])->first();
        $numero = $numeroobj->numerox;
        if ($numero != null) {
            $n = $numero;
            $lastnum = $n;
            $nume = intval($lastnum) + 1;
            $nn = (string) $nume;
            $code = str_pad($nn, 5, "0", STR_PAD_LEFT);
        } else {
            $code = "00001";
        }
        $this->loadModel('Banques');
        $banques = $this->Banques->find('all');
        $this->loadModel('Tos');
        $valeurs = $this->Tos->find('list', ['limit' => 200])->all();
        $this->loadModel('Paiements');
        $paiements = $this->Paiements->find('list', ['limit' => 200])->all();
        $this->loadModel('Carnetcheques');
        $carnetcheques = $this->Carnetcheques->find('list', ['limit' => 200])->all();
        $pointdeventes = $this->Reglements->Pointdeventes->find('list', ['limit' => 200])->all();
        $fournisseurs = $this->Reglements->Fournisseurs->find('list', ['limit' => 200])->all();
        $importations = $this->Reglements->Importations->find('list', ['limit' => 200])->all();
        $utilisateurs = $this->Reglements->Utilisateurs->find('list', ['limit' => 200])->all();
        $exercices = $this->Reglements->Exercices->find('list', ['limit' => 200])->all();
        $devises = $this->Reglements->Devises->find('list', ['limit' => 200])->all();
        $this->set(compact('project_id', 'banques', 'valeurs', 'carnetcheques', 'paiements', 'livraisons', 'factures', 'four', 'p', 'code', 'reglement', 'pointdeventes', 'fournisseurs', 'importations', 'utilisateurs', 'exercices', 'devises'));
    }
    public function impfichiertestprint($id = null)
    {
        $this->loadModel('Commandeclients');
        $this->loadModel('Lignecommandeclients');
        $this->loadModel('Depots');
        $this->loadModel('Pointdeventes');
        $this->loadModel('Clients');
        $commandeclient = $this->Commandeclients->get($id, [
            'contain' => ['Conditionreglements', 'Delailivraisons', 'Methodeexpeditions', 'Lignecommandeclients', 'Clients', 'Projets', 'Incoterms', 'Devises'],
        ]);
        debug($commandeclient);
        $clients = $this->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $pointdeventes = $this->Pointdeventes->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $depots = $this->Depots->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        // $lignecommandeclients = $this->Lignecommandeclients->find('all')->where(["Lignecommandeclients.commandeclient_id=" . $id . " "])->ToArray();
        $connection = ConnectionManager::get('default');
        // $lignecommandeclients = $connection->execute("SELECT lc.* FROM lignecommandeclients lc WHERE commandeclient_id='".$id."' INNER JOIN (SELECT article_id, MAX(prixht) AS max_price FROM lignecommandeclients WHERE commandeclient_id='".$id."' GROUP BY article_id) AS max_prices ON lc.article_id = max_prices.article_id AND lc.prixht = max_prices.max_price;")->fetchAll('assoc');
        // $lignecommandeclients = $connection->execute("SELECT lc.* FROM lignecommandeclients lc INNER JOIN ( SELECT article_id, MAX(prixht) AS max_price FROM lignecommandeclients WHERE commandeclient_id='" . $id . "' GROUP BY article_id) AS max_prices ON lc.article_id = max_prices.article_id AND lc.prixht = max_prices.max_price WHERE lc.commandeclient_id='" . $id . "'")->fetchAll('assoc');
        // $lignecommandeclient2s = $connection->execute("SELECT lc.* FROM lignecommandeclients lc INNER JOIN ( SELECT article_id, MAX(prixht) AS max_price FROM lignecommandeclients WHERE lignecommandeclients.type=2 and commandeclient_id='" . $id . "' GROUP BY article_id) AS max_prices ON lc.article_id = max_prices.article_id AND lc.prixht = max_prices.max_price WHERE lc.commandeclient_id='" . $id . "'")->fetchAll('assoc');

        $lignecommandeclients = $this->Commandeclients->Lignecommandeclients->find('all')->where(["Lignecommandeclients.commandeclient_id=" . $id]); //->ToArray();
        $lignecommandeclient2s = $this->Commandeclients->Lignecommandeclients->find('all')->where(["Lignecommandeclients.commandeclient_id=" . $id, "Lignecommandeclients.type=2"]); //->ToArray();

        // debug($lignecommandeclients);
        $lignecommandeclient2sdes = $this->Commandeclients->Lignecommandeclients->find('all')->where(["Lignecommandeclients.commandeclient_id=" . $id, "Lignecommandeclients.type=2"])->first();
        $this->loadModel('Articles');
        $articles = $this->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation']);
        $societes = $this->fetchTable('Societes')->find('all')->first();
        $compbanq = '';

        if ($commandeclient->projet_id != null) {
            $projeet = $this->fetchTable('Projets')->find('all', [
                'contain' => ['Devises'],
            ])->where(['Projets.id=' . $commandeclient->projet_id])->first();
            debug($commandeclient);
            if ($projeet['banque_id'] && $commandeclient['devis_id']) {
                $comptebanq = $this->fetchTable('ComptesBank')->find('all')->where(['ComptesBank.banque_id=' . $projeet['banque_id'], 'ComptesBank.devise_id=' . $commandeclient['devis_id']])->first();
                // $banquee = $connection->execute("SELECT compte FROM comptesBank WHERE id = '" . $projet[0]['comptesBank_id'] . "'")->fetchAll('assoc');
                $compbanq = $comptebanq['compte'];
            }
        }
        $index = count($lignecommandeclients->toArray()) - count($lignecommandeclient2s->toArray());

        $this->set(compact('index', 'lignecommandeclient2sdes', 'lignecommandeclient2s', 'projeet', 'lignecommandeclients', 'compbanq', 'societes', 'articles', 'commandeclient', 'clients', 'pointdeventes', 'depots'));
    }
    public function imprimeviewnew($id = null)
    {
        $this->loadModel('Commandeclients');
        $this->loadModel('Lignecommandeclients');
        $this->loadModel('Depots');
        $this->loadModel('Pointdeventes');
        $this->loadModel('Clients');
        $commandeclient = $this->Commandeclients->get($id, [
            'contain' => ['Conditionreglements', 'Delailivraisons', 'Methodeexpeditions', 'Lignecommandeclients', 'Clients', 'Projets', 'Incoterms', 'Devises'],
        ]);
        debug($commandeclient);
        $clients = $this->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $pointdeventes = $this->Pointdeventes->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $depots = $this->Depots->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        // $lignecommandeclients = $this->Lignecommandeclients->find('all')->where(["Lignecommandeclients.commandeclient_id=" . $id . " "])->ToArray();
        $connection = ConnectionManager::get('default');
        // $lignecommandeclients = $connection->execute("SELECT lc.* FROM lignecommandeclients lc WHERE commandeclient_id='".$id."' INNER JOIN (SELECT article_id, MAX(prixht) AS max_price FROM lignecommandeclients WHERE commandeclient_id='".$id."' GROUP BY article_id) AS max_prices ON lc.article_id = max_prices.article_id AND lc.prixht = max_prices.max_price;")->fetchAll('assoc');
        // $lignecommandeclients = $connection->execute("SELECT lc.* FROM lignecommandeclients lc INNER JOIN ( SELECT article_id, MAX(prixht) AS max_price FROM lignecommandeclients WHERE commandeclient_id='" . $id . "' GROUP BY article_id) AS max_prices ON lc.article_id = max_prices.article_id AND lc.prixht = max_prices.max_price WHERE lc.commandeclient_id='" . $id . "'")->fetchAll('assoc');
        // $lignecommandeclient2s = $connection->execute("SELECT lc.* FROM lignecommandeclients lc INNER JOIN ( SELECT article_id, MAX(prixht) AS max_price FROM lignecommandeclients WHERE lignecommandeclients.type=2 and commandeclient_id='" . $id . "' GROUP BY article_id) AS max_prices ON lc.article_id = max_prices.article_id AND lc.prixht = max_prices.max_price WHERE lc.commandeclient_id='" . $id . "'")->fetchAll('assoc');

        $lignecommandeclients = $this->Commandeclients->Lignecommandeclients->find('all')->where(["Lignecommandeclients.commandeclient_id=" . $id]); //->ToArray();
        $lignecommandeclient2s = $this->Commandeclients->Lignecommandeclients->find('all')->where(["Lignecommandeclients.commandeclient_id=" . $id, "Lignecommandeclients.type=2"]); //->ToArray();

        // debug($lignecommandeclients);
        $lignecommandeclient2sdes = $this->Commandeclients->Lignecommandeclients->find('all')->where(["Lignecommandeclients.commandeclient_id=" . $id, "Lignecommandeclients.type=2"])->first();
        $this->loadModel('Articles');
        $articles = $this->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation']);
        $societes = $this->fetchTable('Societes')->find('all')->first();
        $compbanq = '';

        if ($commandeclient->projet_id != null) {
            $projeet = $this->fetchTable('Projets')->find('all', [
                'contain' => ['Devises'],
            ])->where(['Projets.id=' . $commandeclient->projet_id])->first();
            debug($commandeclient);
            if ($projeet['banque_id'] && $commandeclient['devis_id']) {
                $comptebanq = $this->fetchTable('ComptesBank')->find('all')->where(['ComptesBank.banque_id=' . $projeet['banque_id'], 'ComptesBank.devise_id=' . $commandeclient['devis_id']])->first();
                // $banquee = $connection->execute("SELECT compte FROM comptesBank WHERE id = '" . $projet[0]['comptesBank_id'] . "'")->fetchAll('assoc');
                $compbanq = $comptebanq['compte'];
            }
        }
        //   Configure::write('debug', true);
        $indexcc = count($lignecommandeclients->toArray()) - count($lignecommandeclient2s->toArray());

        $this->set(compact('lignecommandeclient2sdes', 'indexcc', 'lignecommandeclient2s', 'projeet', 'lignecommandeclients', 'compbanq', 'societes', 'articles', 'commandeclient', 'clients', 'pointdeventes', 'depots'));
    }
    public function imprimeview($id = null)
    {
        $this->loadModel('Commandeclients');
        $this->loadModel('Lignecommandeclients');
        $this->loadModel('Depots');
        $this->loadModel('Pointdeventes');
        $this->loadModel('Clients');
        $commandeclient = $this->Commandeclients->get($id, [
            'contain' => ['Conditionreglements', 'Delailivraisons', 'Methodeexpeditions', 'Lignecommandeclients', 'Clients', 'Projets', 'Incoterms', 'Devises'],
        ]);
        debug($commandeclient);
        $clients = $this->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $pointdeventes = $this->Pointdeventes->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $depots = $this->Depots->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        // $lignecommandeclients = $this->Lignecommandeclients->find('all')->where(["Lignecommandeclients.commandeclient_id=" . $id . " "])->ToArray();
        $connection = ConnectionManager::get('default');
        // $lignecommandeclients = $connection->execute("SELECT lc.* FROM lignecommandeclients lc WHERE commandeclient_id='".$id."' INNER JOIN (SELECT article_id, MAX(prixht) AS max_price FROM lignecommandeclients WHERE commandeclient_id='".$id."' GROUP BY article_id) AS max_prices ON lc.article_id = max_prices.article_id AND lc.prixht = max_prices.max_price;")->fetchAll('assoc');
        // $lignecommandeclients = $connection->execute("SELECT lc.* FROM lignecommandeclients lc INNER JOIN ( SELECT article_id, MAX(prixht) AS max_price FROM lignecommandeclients WHERE commandeclient_id='" . $id . "' GROUP BY article_id) AS max_prices ON lc.article_id = max_prices.article_id AND lc.prixht = max_prices.max_price WHERE lc.commandeclient_id='" . $id . "'")->fetchAll('assoc');
        // $lignecommandeclient2s = $connection->execute("SELECT lc.* FROM lignecommandeclients lc INNER JOIN ( SELECT article_id, MAX(prixht) AS max_price FROM lignecommandeclients WHERE lignecommandeclients.type=2 and commandeclient_id='" . $id . "' GROUP BY article_id) AS max_prices ON lc.article_id = max_prices.article_id AND lc.prixht = max_prices.max_price WHERE lc.commandeclient_id='" . $id . "'")->fetchAll('assoc');

        $lignecommandeclients = $this->Commandeclients->Lignecommandeclients->find('all')->where(["Lignecommandeclients.commandeclient_id=" . $id]); //->ToArray();
        $lignecommandeclient2s = $this->Commandeclients->Lignecommandeclients->find('all')->where(["Lignecommandeclients.commandeclient_id=" . $id, "Lignecommandeclients.type=2"]); //->ToArray();

        // debug($lignecommandeclients);
        $lignecommandeclient2sdes = $this->Commandeclients->Lignecommandeclients->find('all')->where(["Lignecommandeclients.commandeclient_id=" . $id, "Lignecommandeclients.type=2"])->first();
        $this->loadModel('Articles');
        $articles = $this->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation']);
        $societes = $this->fetchTable('Societes')->find('all')->first();
        $compbanq = '';

        if ($commandeclient->projet_id != null) {
            $projeet = $this->fetchTable('Projets')->find('all', [
                'contain' => ['Devises'],
            ])->where(['Projets.id=' . $commandeclient->projet_id])->first();
            debug($commandeclient);
            if ($projeet['banque_id'] && $commandeclient['devis_id']) {
                $comptebanq = $this->fetchTable('ComptesBank')->find('all')->where(['ComptesBank.banque_id=' . $projeet['banque_id'], 'ComptesBank.devise_id=' . $commandeclient['devis_id']])->first();
                // $banquee = $connection->execute("SELECT compte FROM comptesBank WHERE id = '" . $projet[0]['comptesBank_id'] . "'")->fetchAll('assoc');
                $compbanq = $comptebanq['compte'];
            }
        }
        // Configure::write('debug', true);
        $indexcc = count($lignecommandeclients->toArray()) - count($lignecommandeclient2s->toArray());

        $this->set(compact('lignecommandeclient2sdes', 'indexcc', 'lignecommandeclient2s', 'projeet', 'lignecommandeclients', 'compbanq', 'societes', 'articles', 'commandeclient', 'clients', 'pointdeventes', 'depots'));
    }
    public function imprimeview2929082024($id = null)
    {
        $this->loadModel('Commandeclients');
        $this->loadModel('Lignecommandeclients');
        $this->loadModel('Depots');
        $this->loadModel('Pointdeventes');
        $this->loadModel('Clients');
        $commandeclient = $this->Commandeclients->get($id, [
            'contain' => ['Conditionreglements', 'Delailivraisons', 'Methodeexpeditions', 'Lignecommandeclients', 'Clients', 'Projets', 'Incoterms', 'Devises'],
        ]);
        debug($commandeclient);
        $clients = $this->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $pointdeventes = $this->Pointdeventes->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $depots = $this->Depots->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        // $lignecommandeclients = $this->Lignecommandeclients->find('all')->where(["Lignecommandeclients.commandeclient_id=" . $id . " "])->ToArray();
        $connection = ConnectionManager::get('default');
        // $lignecommandeclients = $connection->execute("SELECT lc.* FROM lignecommandeclients lc WHERE commandeclient_id='".$id."' INNER JOIN (SELECT article_id, MAX(prixht) AS max_price FROM lignecommandeclients WHERE commandeclient_id='".$id."' GROUP BY article_id) AS max_prices ON lc.article_id = max_prices.article_id AND lc.prixht = max_prices.max_price;")->fetchAll('assoc');
        // $lignecommandeclients = $connection->execute("SELECT lc.* FROM lignecommandeclients lc INNER JOIN ( SELECT article_id, MAX(prixht) AS max_price FROM lignecommandeclients WHERE commandeclient_id='" . $id . "' GROUP BY article_id) AS max_prices ON lc.article_id = max_prices.article_id AND lc.prixht = max_prices.max_price WHERE lc.commandeclient_id='" . $id . "'")->fetchAll('assoc');
        // $lignecommandeclient2s = $connection->execute("SELECT lc.* FROM lignecommandeclients lc INNER JOIN ( SELECT article_id, MAX(prixht) AS max_price FROM lignecommandeclients WHERE lignecommandeclients.type=2 and commandeclient_id='" . $id . "' GROUP BY article_id) AS max_prices ON lc.article_id = max_prices.article_id AND lc.prixht = max_prices.max_price WHERE lc.commandeclient_id='" . $id . "'")->fetchAll('assoc');

        $lignecommandeclients = $this->Commandeclients->Lignecommandeclients->find('all')->where(["Lignecommandeclients.commandeclient_id=" . $id]); //->ToArray();
        $lignecommandeclient2s = $this->Commandeclients->Lignecommandeclients->find('all')->where(["Lignecommandeclients.commandeclient_id=" . $id, "Lignecommandeclients.type=2"]); //->ToArray();

        // debug($lignecommandeclients);
        $lignecommandeclient2sdes = $this->Commandeclients->Lignecommandeclients->find('all')->where(["Lignecommandeclients.commandeclient_id=" . $id, "Lignecommandeclients.type=2"])->first();
        $this->loadModel('Articles');
        $articles = $this->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation']);
        $societes = $this->fetchTable('Societes')->find('all')->first();
        $compbanq = '';

        if ($commandeclient->projet_id != null) {
            $projeet = $this->fetchTable('Projets')->find('all', [
                'contain' => ['Devises'],
            ])->where(['Projets.id=' . $commandeclient->projet_id])->first();
            debug($commandeclient);
            if ($projeet['banque_id'] && $commandeclient['devis_id']) {
                $comptebanq = $this->fetchTable('ComptesBank')->find('all')->where(['ComptesBank.banque_id=' . $projeet['banque_id'], 'ComptesBank.devise_id=' . $commandeclient['devis_id']])->first();
                // $banquee = $connection->execute("SELECT compte FROM comptesBank WHERE id = '" . $projet[0]['comptesBank_id'] . "'")->fetchAll('assoc');
                $compbanq = $comptebanq['compte'];
            }
        }

        $this->set(compact('lignecommandeclient2sdes', 'lignecommandeclient2s', 'projeet', 'lignecommandeclients', 'compbanq', 'societes', 'articles', 'commandeclient', 'clients', 'pointdeventes', 'depots'));
    }
    public function pdf($id = null)
    {
        $this->loadModel('Commandeclients');
        $this->loadModel('Lignecommandeclients');
        $this->loadModel('Depots');
        $this->loadModel('Pointdeventes');
        $this->loadModel('Clients');
        $commandeclient = $this->Commandeclients->get($id, [
            'contain' => ['Conditionreglements', 'Delailivraisons', 'Methodeexpeditions', 'Lignecommandeclients', 'Clients', 'Projets', 'Incoterms', 'Devises'],
        ]);
        debug($commandeclient);
        $clients = $this->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $pointdeventes = $this->Pointdeventes->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $depots = $this->Depots->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        // $lignecommandeclients = $this->Lignecommandeclients->find('all')->where(["Lignecommandeclients.commandeclient_id=" . $id . " "])->ToArray();
        $connection = ConnectionManager::get('default');
        // $lignecommandeclients = $connection->execute("SELECT lc.* FROM lignecommandeclients lc WHERE commandeclient_id='".$id."' INNER JOIN (SELECT article_id, MAX(prixht) AS max_price FROM lignecommandeclients WHERE commandeclient_id='".$id."' GROUP BY article_id) AS max_prices ON lc.article_id = max_prices.article_id AND lc.prixht = max_prices.max_price;")->fetchAll('assoc');
        // $lignecommandeclients = $connection->execute("SELECT lc.* FROM lignecommandeclients lc INNER JOIN ( SELECT article_id, MAX(prixht) AS max_price FROM lignecommandeclients WHERE commandeclient_id='" . $id . "' GROUP BY article_id) AS max_prices ON lc.article_id = max_prices.article_id AND lc.prixht = max_prices.max_price WHERE lc.commandeclient_id='" . $id . "'")->fetchAll('assoc');
        // $lignecommandeclient2s = $connection->execute("SELECT lc.* FROM lignecommandeclients lc INNER JOIN ( SELECT article_id, MAX(prixht) AS max_price FROM lignecommandeclients WHERE lignecommandeclients.type=2 and commandeclient_id='" . $id . "' GROUP BY article_id) AS max_prices ON lc.article_id = max_prices.article_id AND lc.prixht = max_prices.max_price WHERE lc.commandeclient_id='" . $id . "'")->fetchAll('assoc');

        $lignecommandeclients = $this->Commandeclients->Lignecommandeclients->find('all')->where(["Lignecommandeclients.commandeclient_id=" . $id]); //->ToArray();
        $lignecommandeclient2s = $this->Commandeclients->Lignecommandeclients->find('all')->where(["Lignecommandeclients.commandeclient_id=" . $id, "Lignecommandeclients.type=2"]); //->ToArray();

        // debug($lignecommandeclients);
        $lignecommandeclient2sdes = $this->Commandeclients->Lignecommandeclients->find('all')->where(["Lignecommandeclients.commandeclient_id=" . $id, "Lignecommandeclients.type=2"])->first();
        $this->loadModel('Articles');
        $articles = $this->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation']);
        $societes = $this->fetchTable('Societes')->find('all')->first();
        $compbanq = '';

        if ($commandeclient->projet_id != null) {
            $projeet = $this->fetchTable('Projets')->find('all', [
                'contain' => ['Devises'],
            ])->where(['Projets.id=' . $commandeclient->projet_id])->first();
            debug($commandeclient);
            if ($projeet['banque_id'] && $commandeclient['devis_id']) {
                $comptebanq = $this->fetchTable('ComptesBank')->find('all')->where(['ComptesBank.banque_id=' . $projeet['banque_id'], 'ComptesBank.devise_id=' . $commandeclient['devis_id']])->first();
                // $banquee = $connection->execute("SELECT compte FROM comptesBank WHERE id = '" . $projet[0]['comptesBank_id'] . "'")->fetchAll('assoc');
                $compbanq = $comptebanq['compte'];
            }
        }

        $this->set(compact('lignecommandeclient2sdes', 'lignecommandeclient2s', 'projeet', 'lignecommandeclients', 'compbanq', 'societes', 'articles', 'commandeclient', 'clients', 'pointdeventes', 'depots'));
    }
    public function impfichiertest($id = null)
    {
        $this->loadModel('Commandeclients');
        $this->loadModel('Lignecommandeclients');
        $this->loadModel('Depots');
        $this->loadModel('Pointdeventes');
        $this->loadModel('Clients');
        $commandeclient = $this->Commandeclients->get($id, [
            'contain' => ['Conditionreglements', 'Delailivraisons', 'Methodeexpeditions', 'Lignecommandeclients', 'Clients', 'Projets', 'Incoterms', 'Devises'],
        ]);
        $project_id = $commandeclient['projet_id'];
        debug($commandeclient);
        $clients = $this->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $pointdeventes = $this->Pointdeventes->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $depots = $this->Depots->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        // $lignecommandeclients = $this->Lignecommandeclients->find('all')->where(["Lignecommandeclients.commandeclient_id=" . $id . " "])->ToArray();
        $connection = ConnectionManager::get('default');
        // $lignecommandeclients = $connection->execute("SELECT lc.* FROM lignecommandeclients lc WHERE commandeclient_id='".$id."' INNER JOIN (SELECT article_id, MAX(prixht) AS max_price FROM lignecommandeclients WHERE commandeclient_id='".$id."' GROUP BY article_id) AS max_prices ON lc.article_id = max_prices.article_id AND lc.prixht = max_prices.max_price;")->fetchAll('assoc');
        // $lignecommandeclients = $connection->execute("SELECT lc.* FROM lignecommandeclients lc INNER JOIN ( SELECT article_id, MAX(prixht) AS max_price FROM lignecommandeclients WHERE commandeclient_id='" . $id . "' GROUP BY article_id) AS max_prices ON lc.article_id = max_prices.article_id AND lc.prixht = max_prices.max_price WHERE lc.commandeclient_id='" . $id . "'")->fetchAll('assoc');
        // $lignecommandeclient2s = $connection->execute("SELECT lc.* FROM lignecommandeclients lc INNER JOIN ( SELECT article_id, MAX(prixht) AS max_price FROM lignecommandeclients WHERE lignecommandeclients.type=2 and commandeclient_id='" . $id . "' GROUP BY article_id) AS max_prices ON lc.article_id = max_prices.article_id AND lc.prixht = max_prices.max_price WHERE lc.commandeclient_id='" . $id . "'")->fetchAll('assoc');

        $lignecommandeclients = $this->Commandeclients->Lignecommandeclients->find('all')->where(["Lignecommandeclients.commandeclient_id=" . $id]); //->ToArray();
        $lignecommandeclient2s = $this->Commandeclients->Lignecommandeclients->find('all')->where(["Lignecommandeclients.commandeclient_id=" . $id, "Lignecommandeclients.type=2"]); //->ToArray();

        // debug($lignecommandeclients);
        $lignecommandeclient2sdes = $this->Commandeclients->Lignecommandeclients->find('all')->where(["Lignecommandeclients.commandeclient_id=" . $id, "Lignecommandeclients.type=2"])->first();
        $this->loadModel('Articles');
        $articles = $this->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation']);
        $societes = $this->fetchTable('Societes')->find('all')->first();
        $compbanq = '';

        if ($commandeclient->projet_id != null) {
            $projeet = $this->fetchTable('Projets')->find('all', [
                'contain' => ['Devises'],
            ])->where(['Projets.id=' . $commandeclient->projet_id])->first();
            debug($commandeclient);
            if ($projeet['banque_id'] && $commandeclient['devis_id']) {
                $comptebanq = $this->fetchTable('ComptesBank')->find('all')->where(['ComptesBank.banque_id=' . $projeet['banque_id'], 'ComptesBank.devise_id=' . $commandeclient['devis_id']])->first();
                // $banquee = $connection->execute("SELECT compte FROM comptesBank WHERE id = '" . $projet[0]['comptesBank_id'] . "'")->fetchAll('assoc');
                $compbanq = $comptebanq['compte'];
            }
        }

        $this->set(compact('id', 'project_id', 'lignecommandeclient2sdes', 'lignecommandeclient2s', 'projeet', 'lignecommandeclients', 'compbanq', 'societes', 'articles', 'commandeclient', 'clients', 'pointdeventes', 'depots'));
    }

    public function impfichier($id = null)
    {
        $this->loadModel('Commandeclients');
        $this->loadModel('Lignecommandeclients');
        $this->loadModel('Depots');
        $this->loadModel('Pointdeventes');
        $this->loadModel('Clients');
        $commandeclient = $this->Commandeclients->get($id, [
            'contain' => ['Conditionreglements', 'Delailivraisons', 'Methodeexpeditions', 'Lignecommandeclients', 'Clients', 'Projets', 'Incoterms', 'Devises'],
        ]);
        $project_id = $commandeclient['projet_id'];
        debug($commandeclient);
        $clients = $this->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $pointdeventes = $this->Pointdeventes->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $depots = $this->Depots->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        // $lignecommandeclients = $this->Lignecommandeclients->find('all')->where(["Lignecommandeclients.commandeclient_id=" . $id . " "])->ToArray();
        $connection = ConnectionManager::get('default');
        // $lignecommandeclients = $connection->execute("SELECT lc.* FROM lignecommandeclients lc WHERE commandeclient_id='".$id."' INNER JOIN (SELECT article_id, MAX(prixht) AS max_price FROM lignecommandeclients WHERE commandeclient_id='".$id."' GROUP BY article_id) AS max_prices ON lc.article_id = max_prices.article_id AND lc.prixht = max_prices.max_price;")->fetchAll('assoc');
        // $lignecommandeclients = $connection->execute("SELECT lc.* FROM lignecommandeclients lc INNER JOIN ( SELECT article_id, MAX(prixht) AS max_price FROM lignecommandeclients WHERE commandeclient_id='" . $id . "' GROUP BY article_id) AS max_prices ON lc.article_id = max_prices.article_id AND lc.prixht = max_prices.max_price WHERE lc.commandeclient_id='" . $id . "'")->fetchAll('assoc');
        // $lignecommandeclient2s = $connection->execute("SELECT lc.* FROM lignecommandeclients lc INNER JOIN ( SELECT article_id, MAX(prixht) AS max_price FROM lignecommandeclients WHERE lignecommandeclients.type=2 and commandeclient_id='" . $id . "' GROUP BY article_id) AS max_prices ON lc.article_id = max_prices.article_id AND lc.prixht = max_prices.max_price WHERE lc.commandeclient_id='" . $id . "'")->fetchAll('assoc');

        $lignecommandeclients = $this->Commandeclients->Lignecommandeclients->find('all')->where(["Lignecommandeclients.commandeclient_id=" . $id]); //->ToArray();
        $lignecommandeclient2s = $this->Commandeclients->Lignecommandeclients->find('all')->where(["Lignecommandeclients.commandeclient_id=" . $id, "Lignecommandeclients.type=2"]); //->ToArray();

        // debug($lignecommandeclients);
        $lignecommandeclient2sdes = $this->Commandeclients->Lignecommandeclients->find('all')->where(["Lignecommandeclients.commandeclient_id=" . $id, "Lignecommandeclients.type=2"])->first();
        $this->loadModel('Articles');
        $articles = $this->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation']);
        $societes = $this->fetchTable('Societes')->find('all')->first();
        $compbanq = '';

        if ($commandeclient->projet_id != null) {
            $projeet = $this->fetchTable('Projets')->find('all', [
                'contain' => ['Devises'],
            ])->where(['Projets.id=' . $commandeclient->projet_id])->first();
            debug($commandeclient);
            if ($projeet['banque_id'] && $commandeclient['devis_id']) {
                $comptebanq = $this->fetchTable('ComptesBank')->find('all')->where(['ComptesBank.banque_id=' . $projeet['banque_id'], 'ComptesBank.devise_id=' . $commandeclient['devis_id']])->first();
                // $banquee = $connection->execute("SELECT compte FROM comptesBank WHERE id = '" . $projet[0]['comptesBank_id'] . "'")->fetchAll('assoc');
                $compbanq = $comptebanq['compte'];
            }
        }
        $index = count($lignecommandeclients->toArray()) - count($lignecommandeclient2s->toArray());

        $this->set(compact('index', 'id', 'project_id', 'lignecommandeclient2sdes', 'lignecommandeclient2s', 'projeet', 'lignecommandeclients', 'compbanq', 'societes', 'articles', 'commandeclient', 'clients', 'pointdeventes', 'depots'));
    }
    public function imprimeview132($id = null)
    {
        $this->loadModel('Commandeclients');
        $this->loadModel('Lignecommandeclients');
        $this->loadModel('Depots');
        $this->loadModel('Pointdeventes');
        $this->loadModel('Clients');
        $commandeclient = $this->Commandeclients->get($id, [
            'contain' => ['Conditionreglements', 'Delailivraisons', 'Methodeexpeditions', 'Lignecommandeclients', 'Clients', 'Projets', 'Incoterms', 'Devises'],
        ]);
        debug($commandeclient);
        $clients = $this->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $pointdeventes = $this->Pointdeventes->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $depots = $this->Depots->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        // $lignecommandeclients = $this->Lignecommandeclients->find('all')->where(["Lignecommandeclients.commandeclient_id=" . $id . " "])->ToArray();
        $connection = ConnectionManager::get('default');
        // $lignecommandeclients = $connection->execute("SELECT lc.* FROM lignecommandeclients lc WHERE commandeclient_id='".$id."' INNER JOIN (SELECT article_id, MAX(prixht) AS max_price FROM lignecommandeclients WHERE commandeclient_id='".$id."' GROUP BY article_id) AS max_prices ON lc.article_id = max_prices.article_id AND lc.prixht = max_prices.max_price;")->fetchAll('assoc');
        // $lignecommandeclients = $connection->execute("SELECT lc.* FROM lignecommandeclients lc INNER JOIN ( SELECT article_id, MAX(prixht) AS max_price FROM lignecommandeclients WHERE commandeclient_id='" . $id . "' GROUP BY article_id) AS max_prices ON lc.article_id = max_prices.article_id AND lc.prixht = max_prices.max_price WHERE lc.commandeclient_id='" . $id . "'")->fetchAll('assoc');
        // $lignecommandeclient2s = $connection->execute("SELECT lc.* FROM lignecommandeclients lc INNER JOIN ( SELECT article_id, MAX(prixht) AS max_price FROM lignecommandeclients WHERE lignecommandeclients.type=2 and commandeclient_id='" . $id . "' GROUP BY article_id) AS max_prices ON lc.article_id = max_prices.article_id AND lc.prixht = max_prices.max_price WHERE lc.commandeclient_id='" . $id . "'")->fetchAll('assoc');

        $lignecommandeclients = $this->Commandeclients->Lignecommandeclients->find('all')->where(["Lignecommandeclients.commandeclient_id=" . $id]); //->ToArray();
        $lignecommandeclient2s = $this->Commandeclients->Lignecommandeclients->find('all')->where(["Lignecommandeclients.commandeclient_id=" . $id, "Lignecommandeclients.type=2"]); //->ToArray();

        // debug($lignecommandeclients);
        $lignecommandeclient2sdes = $this->Commandeclients->Lignecommandeclients->find('all')->where(["Lignecommandeclients.commandeclient_id=" . $id, "Lignecommandeclients.type=2"])->first();
        $this->loadModel('Articles');
        $articles = $this->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation']);
        $societes = $this->fetchTable('Societes')->find('all')->first();
        $compbanq = '';

        if ($commandeclient->projet_id != null) {
            $projeet = $this->fetchTable('Projets')->find('all', [
                'contain' => ['Devises'],
            ])->where(['Projets.id=' . $commandeclient->projet_id])->first();
            debug($commandeclient);
            if ($projeet['banque_id'] && $commandeclient['devis_id']) {
                $comptebanq = $this->fetchTable('ComptesBank')->find('all')->where(['ComptesBank.banque_id=' . $projeet['banque_id'], 'ComptesBank.devise_id=' . $commandeclient['devis_id']])->first();
                // $banquee = $connection->execute("SELECT compte FROM comptesBank WHERE id = '" . $projet[0]['comptesBank_id'] . "'")->fetchAll('assoc');
                $compbanq = $comptebanq['compte'];
            }
        }

        $this->set(compact('lignecommandeclient2sdes', 'lignecommandeclient2s', 'projeet', 'lignecommandeclients', 'compbanq', 'societes', 'articles', 'commandeclient', 'clients', 'pointdeventes', 'depots'));
    }
    public function imprimeviewson($id = null)
    {
        $this->loadModel('Commandeclients');
        $this->loadModel('Lignecommandeclients');
        $this->loadModel('Depots');
        $this->loadModel('Pointdeventes');
        $this->loadModel('Clients');
        $commandeclient = $this->Commandeclients->get($id, [
            'contain' => ['Conditionreglements', 'Delailivraisons', 'Methodeexpeditions', 'Lignecommandeclients', 'Clients', 'Projets', 'Incoterms', 'Devises'],
        ]);
        debug($commandeclient);
        $clients = $this->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $pointdeventes = $this->Pointdeventes->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $depots = $this->Depots->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        // $lignecommandeclients = $this->Lignecommandeclients->find('all')->where(["Lignecommandeclients.commandeclient_id=" . $id . " "])->ToArray();
        $connection = ConnectionManager::get('default');
        // $lignecommandeclients = $connection->execute("SELECT lc.* FROM lignecommandeclients lc WHERE commandeclient_id='".$id."' INNER JOIN (SELECT article_id, MAX(prixht) AS max_price FROM lignecommandeclients WHERE commandeclient_id='".$id."' GROUP BY article_id) AS max_prices ON lc.article_id = max_prices.article_id AND lc.prixht = max_prices.max_price;")->fetchAll('assoc');
        // $lignecommandeclients = $connection->execute("SELECT lc.* FROM lignecommandeclients lc INNER JOIN ( SELECT article_id, MAX(prixht) AS max_price FROM lignecommandeclients WHERE commandeclient_id='" . $id . "' GROUP BY article_id) AS max_prices ON lc.article_id = max_prices.article_id AND lc.prixht = max_prices.max_price WHERE lc.commandeclient_id='" . $id . "'")->fetchAll('assoc');
        // $lignecommandeclient2s = $connection->execute("SELECT lc.* FROM lignecommandeclients lc INNER JOIN ( SELECT article_id, MAX(prixht) AS max_price FROM lignecommandeclients WHERE lignecommandeclients.type=2 and commandeclient_id='" . $id . "' GROUP BY article_id) AS max_prices ON lc.article_id = max_prices.article_id AND lc.prixht = max_prices.max_price WHERE lc.commandeclient_id='" . $id . "'")->fetchAll('assoc');

        $lignecommandeclients = $this->Commandeclients->Lignecommandeclients->find('all')->where(["Lignecommandeclients.commandeclient_id=" . $id]); //->ToArray();
        $lignecommandeclient2s = $this->Commandeclients->Lignecommandeclients->find('all')->where(["Lignecommandeclients.commandeclient_id=" . $id, "Lignecommandeclients.type=2"]); //->ToArray();

        // debug($lignecommandeclients);
        $lignecommandeclient2sdes = $this->Commandeclients->Lignecommandeclients->find('all')->where(["Lignecommandeclients.commandeclient_id=" . $id, "Lignecommandeclients.type=2"])->first();
        $this->loadModel('Articles');
        $articles = $this->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation']);
        $societes = $this->fetchTable('Societes')->find('all')->first();
        $compbanq = '';

        if ($commandeclient->projet_id != null) {
            $projeet = $this->fetchTable('Projets')->find('all', [
                'contain' => ['Devises'],
            ])->where(['Projets.id=' . $commandeclient->projet_id])->first();
            debug($commandeclient);
            if ($projeet['banque_id'] && $commandeclient['devis_id']) {
                $comptebanq = $this->fetchTable('ComptesBank')->find('all')->where(['ComptesBank.banque_id=' . $projeet['banque_id'], 'ComptesBank.devise_id=' . $commandeclient['devis_id']])->first();
                // $banquee = $connection->execute("SELECT compte FROM comptesBank WHERE id = '" . $projet[0]['comptesBank_id'] . "'")->fetchAll('assoc');
                $compbanq = $comptebanq['compte'];
            }
        }

        $this->set(compact('lignecommandeclient2sdes', 'lignecommandeclient2s', 'projeet', 'lignecommandeclients', 'compbanq', 'societes', 'articles', 'commandeclient', 'clients', 'pointdeventes', 'depots'));
    }
    public function imprimefacture($id = null)
    {
        $this->loadModel('Factures');
        $this->loadModel('Lignefactures');
        $this->loadModel('Depots');
        $this->loadModel('Pointdeventes');
        $this->loadModel('Clients');
        $facture = $this->Factures->get($id, [
            'contain' => ['Fournisseurs', 'Lignefactures', 'Projets', 'Incoterms', 'Devises'],
        ]);
        $clients = $this->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $pointdeventes = $this->Pointdeventes->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $depots = $this->Depots->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $lignefactures = $this->Lignefactures->find('all')->where(["Lignefactures.facture_id=" . $id . " "]);
        $this->loadModel('Articles');
        $articles = $this->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation']);
        $societes = $this->fetchTable('Societes')->find('all')->first();
        $compbanq = '';

        if ($facture->projet_id != null) {
            $projeet = $this->fetchTable('Projets')->find('all')->where(['id=' . $facture->projet_id])->first();

            if ($projeet['comptesBank_id']) {
                $comptebanq = $this->fetchTable('ComptesBank')->find('all')->where(['id=' . $projeet['comptesBank_id']])->first();
                // $banquee = $connection->execute("SELECT compte FROM comptesBank WHERE id = '" . $projet[0]['comptesBank_id'] . "'")->fetchAll('assoc');
                $compbanq = $comptebanq['compte'];
            }
        }
        $this->set(compact('lignefactures', 'compbanq', 'societes', 'articles', 'facture', 'clients', 'pointdeventes', 'depots'));
    }
    public function addindirectreg($project_id = null, $factureclient_id = null, $client_id = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_vente' . $abrv);
        $reglementclient = 0;
        foreach ($liendd as $k => $liens) {
            if (@$liens['lien'] == 'reglementclients') {
                $reglementclient = $liens['ajout'];
            }
        }
        if (($reglementclient <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $this->loadModel('Reglementclients');
        $this->loadModel('Factureclients');
        $this->loadModel('Bonlivraisons');
        $this->loadModel('Lignereglementclients');
        $this->loadModel('Piecereglementclients');
        $reglementclient = $this->Reglementclients->newEmptyEntity();
        if ($this->request->is('post')) {
            $data['numeroconca'] = $this->request->getData('numeroconca');
            $data['Date'] = $this->request->getData('Date');
            $data['projet_id'] = $project_id;
            $data['client_id'] = $this->request->getData('client_id');
            $data['Montant'] = $this->request->getData('data')['Reglementclient']['Montant'];
            $data['ttpayer'] = $this->request->getData('data')['Reglementclient']['ttpayer'];
            $numeroobj = $this->Reglementclients->find()->select([
                "numero" =>
                'MAX(Reglementclients.numeroconca)'
            ])->first();
            $numero = $numeroobj->numero;
            if ($numero != null) {
                $n = $numero;
                $lastnum = $n;
                $nume = intval($lastnum) + 1;
                $nn = (string) $nume;
                $code = str_pad($nn, 5, "0", STR_PAD_LEFT);
            } else {
                $code = "00001";
            }
            $reglement = $this->Reglementclients->patchEntity($reglementclient, $data);
            if ($this->Reglementclients->save($reglement)) {
                $reglement_id = $reglement->id;
                $this->misejour("Reglementclients", "add", $reglement_id);
                $projet_id = $reglement['projet_id'];
                $this->loadModel('Projets');
                $projet = $this->Projets->get($projet_id);
                $datetimeActuelle = FrozenTime::now();
                $datetimeActuelle->format('Y-m-d H:i:s');
                $projet->datemodification = $datetimeActuelle;
                $this->Projets->save($projet);
                if (isset($this->request->getData('data')['Lignereglementclient']) && (!empty($this->request->getData('data')['Lignereglementclient']))) {
                    foreach ($this->request->getData('data')['Lignereglementclient'] as $i => $l) {
                        if (isset($l['factureclient_id'])) {
                            $ta = $this->fetchTable('Lignereglementclients')->newEmptyEntity();
                            $ta['reglementclient_id'] = $reglement_id;
                            $ta['factureclient_id'] = $l['factureclient_id'];
                            $ta['Montant'] = $l['Montanttt'];
                            $mtg = $this->Factureclients->find()->select([
                                "mtreg" =>
                                'Factureclients.Montant_Regler'
                            ])->where(['Factureclients.id =' . $l['factureclient_id']])->first();
                            $MontantRegler = $mtg->mtreg;
                            $fact = $this->Factureclients->get($l['factureclient_id']);
                            $fact->Montant_Regler = $MontantRegler + $l['Montanttt'];
                            $fact->poste = 1;
                            $this->Factureclients->save($fact);
                            $this->fetchTable('Lignereglementclients')->save($ta);
                        }

                        // if (isset($l['bonreception_id'])) {
                        //     $tabb = $this->fetchTable('Lignereglementclients')->newEmptyEntity();
                        //     $tabb['reglementclient_id'] = $reglement_id;
                        //     $tabb['bonlivraison_id'] = $l['bonreception_id'];
                        //     $tabb['Montant'] = $l['ttc'];
                        //     $this->fetchTable('Lignereglementclients')->save($tabb);
                        //     $mtg = $this->Bonlivraisons->find()->select(["mtreg" =>
                        //     'Bonlivraisons.Montant_Regler'])->where(['Bonlivraisons.id =' . $l['bonreception_id']])->first();
                        //     $MontantRegler = $mtg->mtreg;
                        //     $fact = $this->Bonlivraisons->get($l['bonreception_id']);
                        //     $fact->Montant_Regler = $MontantRegler + $l['ttc'];
                        //     $this->Bonlivraisons->save($fact);
                        // }

                    }
                }
                if (isset($this->request->getData('data')['pieceregelemnt']) && (!empty($this->request->getData('data')['pieceregelemnt']))) {
                    foreach ($this->request->getData('data')['pieceregelemnt'] as $j => $p) {
                        if (isset($p['sup']) && $p['sup'] != 1) {
                            $tab = $this->fetchTable('Piecereglementclients')->newEmptyEntity();
                            $tab['reglementclient_id'] = $reglement_id;
                            $tab['paiement_id'] = $p['paiement_id'];
                            $tab['montant'] = (float) $p['montant'];
                            $tab['banque_id'] = $p['banque_id'];
                            $tab['to_id'] = $p['taux'];
                            $tab['montant_net'] = (float) $p['montantnet'];
                            $tab['echance'] = $p['echance'];
                            $tab['carnetcheque_id'] = $p['carnetcheque_id'];
                            $tab['num'] = $p['num_piece'];
                            $this->fetchTable('Piecereglementclients')->save($tab);
                        }
                    }
                }

                return $this->redirect(['action' => 'vieww/', $project_id]);
            }
        }
        $factureclients = '';
        $livraisons = '';
        $moderegle = '';
        $cond = '';
        if ($client_id != null) {
            $this->loadModel('Factureclients');
            $this->loadModel('Bonlivraisons');
            $this->loadModel('Piecereglements');
            $this->loadModel('Clientpaiements');
            $this->loadModel('Commandeclients');

            $factureclients = $this->Factureclients->find('all')->where(['Factureclients.client_id =' . $client_id, 'Factureclients.id =' . $factureclient_id, 'Factureclients.totalttc > Factureclients.Montant_Regler']);
            $livraisons = $this->Bonlivraisons->find('all')->where(['Bonlivraisons.client_id =' . $client_id/*, 'Bonivraisons.totalttc > Livraisons.Montant_Regler', 'Livraisons.pointdevente_id =' . $p*/, 'Bonlivraisons.factureclient_id' => 0/* ,'Bonlivraisons.bl'=>1 */]);
            // debug($factureclients->toArray());die;

            foreach ($factureclients as $fc) {
                //   $comm = $this->Commandeclients->find('all');/->where(['Commandeclients.factureclient_id =' . $fc->id]);

                $paiementclients = $this->Clientpaiements->find('all')->where(['Clientpaiements.commandeclient_id =' . $fc->commandeclient_id]);
                $mode = '(0';
                foreach ($paiementclients as $pc) {
                    $mode .= ',' . $pc->paiement_id;
                }
                $mode .= ')';
            }
            $cond .= 'Paiements.id in ' . $mode;
        }
        $numeroobj = $this->Reglementclients->find()->select([
            "numero" =>
            'MAX(Reglementclients.numeroconca)'
        ])->first();
        $numero = $numeroobj->numero;
        if ($numero != null) {
            $n = $numero;
            $lastnum = $n;
            $nume = intval($lastnum) + 1;
            $nn = (string) $nume;
            $code = str_pad($nn, 5, "0", STR_PAD_LEFT);
        } else {
            $code = "00001";
        }
        $this->loadModel('Modalites');
        $modalites = $this->fetchTable('Modalites')->find('all', [
            'contain' => ['Paiements'],
        ])->where('Modalites.client_id =' . $client_id);
        $this->loadModel('Tos');

        $valeurs = $this->Tos->find('list', ['limit' => 200])->all();
        $this->loadModel('Paiements');
        $paiements = $this->Paiements->find('list', ['limit' => 200])->where([/*$cond*/])->all();
        $this->loadModel('Carnetcheques');
        $carnetcheques = $this->Carnetcheques->find('list', ['limit' => 200])->all();
        $cha = "TRUE";
        $banques = $this->fetchTable('Banques')->find('all', ['keyField' => 'id', 'valueField' => 'name']);
        $clients = $this->Reglementclients->Clients->find('all');
        $importations = $this->Reglementclients->Importations->find('list', ['limit' => 200])->all();
        $utilisateurs = $this->Reglementclients->Utilisateurs->find('list', ['limit' => 200])->all();
        $exercices = $this->Reglementclients->Exercices->find('list', ['limit' => 200])->all();
        $devises = $this->Reglementclients->Devises->find('list', ['limit' => 200])->all();
        $piecereglements = $this->Piecereglements->find('all');
        $this->set(compact('project_id', 'piecereglements', 'banques', 'valeurs', 'modalites', 'carnetcheques', 'paiements', 'livraisons', 'factureclients', 'client_id', 'code', 'reglementclient', 'clients', 'importations', 'utilisateurs', 'exercices', 'devises'));
    }
    public function editregcli($id = null, $project_id = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_vente' . $abrv);
        $reglementclient = 0;
        foreach ($liendd as $k => $liens) {
            if (@$liens['lien'] == 'reglementclients') {
                $reglementclient = $liens['modif'];
            }
        }
        if (($reglementclient <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $this->loadModel('Factureclients');
        $this->loadModel('Bonlivraisons');
        $this->loadModel('Reglementclients');
        $this->loadModel('Lignereglementclients');
        $this->loadModel('Piecereglementclients');
        $reglement = $this->Reglementclients->get($id, [
            'contain' => ['Projets', 'Clients'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data['numeroconca'] = $this->request->getData('numeroconca');
            $data['Date'] = $this->request->getData('Date');
            $data['client_id'] = $this->request->getData('client_id');
            $data['projet_id'] = $project_id;
            $data['Montant'] = $this->request->getData('data')['Reglementclients']['Montant'];
            $data['ttpayer'] = $this->request->getData('data')['Reglementclients']['ttpayer'];
            $reglement = $this->Reglementclients->patchEntity($reglement, $data);

            if ($this->Reglementclients->save($reglement)) {
                $projet_id = $reglement['projet_id'];
                $this->loadModel('Projets');
                $projet = $this->Projets->get($projet_id);
                $datetimeActuelle = FrozenTime::now();
                $datetimeActuelle->format('Y-m-d H:i:s');
                $projet->datemodification = $datetimeActuelle;
                $this->Projets->save($projet);
                $this->misejour("Reglementclients", "edit", $projet_id);
                $lignes = $this->Lignereglementclients->find()->where(["Lignereglementclients.reglementclient_id=" . $id])->all();
                foreach ($lignes as $item) {
                    if ($item['factureclient_id'] != null) {
                        $mtg = $this->Factureclients->find()->select([
                            "mtreg" =>
                            'Factureclients.Montant_Regler'
                        ])->where(['Factureclients.id =' . $item['factureclient_id']])->first();
                        $MontantRegler = $mtg->mtreg;
                        $fact = $this->Factureclients->get($item['factureclient_id']);
                        $fact->Montant_Regler = $MontantRegler - $item['Montant'];
                        $this->Factureclients->save($fact);
                    }
                    if ($item['Bonlivraison_id'] != null) {
                        $mtg = $this->Bonlivraisons->find()->select([
                            "mtreg" =>
                            'Bonlivraisons.Montant_Regler'
                        ])->where(['Bonlivraisons.id =' . $item['bonlivraison_id']])->first();
                        $MontantRegler = $mtg->mtreg;
                        $fact = $this->Bonlivraisons->get($item['bonlivraison_id']);
                        $fact->Montant_Regler = $MontantRegler - $item['Montant'];
                        $this->Bonlivraisons->save($fact);
                    }
                    $this->Lignereglementclients->delete($item);
                }
                $lignes2 = $this->Piecereglementclients->find()->where(["Piecereglementclients.reglementclient_id =" . $id])->all();
                foreach ($lignes2 as $item) {
                    $this->Piecereglementclients->delete($item);
                }
                if (isset($this->request->getData('data')['Lignereglementclient']) && (!empty($this->request->getData('data')['Lignereglementclient']))) {
                    foreach ($this->request->getData('data')['Lignereglementclient'] as $i => $l) {
                        if (isset($l['factureclient_id'])) {
                            $ta = $this->fetchTable('Lignereglementclients')->newEmptyEntity();
                            $ta['reglementclient_id'] = $id;
                            $ta['factureclient_id'] = $l['factureclient_id'];

                            $ta['Montant'] = $l['Montanttt'];
                            $mtg = $this->Factureclients->find()->select([
                                "mtreg" =>
                                'Factureclients.Montant_Regler'
                            ])->where(['Factureclients.id =' . $l['factureclient_id']])->first();
                            $MontantRegler = $mtg->mtreg;
                            $fact = $this->Factureclients->get($l['factureclient_id']);
                            $fact->Montant_Regler = $MontantRegler + $l['Montanttt'];
                            $this->Factureclients->save($fact);
                            $this->fetchTable('Lignereglementclients')->save($ta);
                        }
                    }
                }
                if (isset($this->request->getData('data')['pieceregelemnt']) && (!empty($this->request->getData('data')['pieceregelemnt']))) {
                    foreach ($this->request->getData('data')['pieceregelemnt'] as $j => $p) {
                        if (isset($p['sup']) && $p['sup'] != 1) {
                            $tab = $this->fetchTable('Piecereglementclients')->newEmptyEntity();
                            $tab['reglementclient_id'] = $id;
                            $tab['paiement_id'] = $p['paiement_id'];
                            $tab['banque_id'] = $p['banque_id'];
                            $tab['montant'] = $p['montant'];
                            $tab['to_id'] = $p['taux'];
                            $tab['montant_net'] = $p['montantnet'];
                            $tab['echance'] = $p['echance'];
                            $tab['carnetcheque_id'] = $p['carnetcheque_id'];
                            $tab['num'] = $p['num_piece'];
                            $this->fetchTable('Piecereglementclients')->save($tab);
                        }
                    }
                }
                return $this->redirect(['action' => 'editregcli/', $id, $project_id]);
            }
        }
        $lignesreg = $this->Lignereglementclients->find('all')->where(['Lignereglementclients.reglementclient_id =' . $id]);
        $piecereglementclients = $this->Piecereglementclients->find('all', ['contain' => ['Paiements']])
            ->where(['Piecereglementclients.reglementclient_id' => $id]);
        $mtbon = 0.000;
        $mtfact = 0.000;
        foreach ($lignesreg as $k => $ligne) {
            if ($ligne['factureclient_id'] != null) {
                $facreg[$ligne['factureclient_id']] = 1;
                $mtfact = $mtfact + $ligne['Montant'];
            } else {
                $facreg[$ligne['bonlivraison_id']] = 1;
                $mtbon = $mtbon + $ligne['Montant'];
            }
        }
        $cli = $reglement->client_id;
        $cond = '';

        $l = '(0';
        $lb = '(0';
        $la = '(0';
        $lpub = '(0';
        foreach ($lignesreg as $li) {


            if ($li['factureclient_id'] != 0) {
                $l = $l . ',' . $li['factureclient_id'];
            } else if ($li['bonlivraison_id'] != 0) {
                $lb = $lb . ',' . $li['bonlivraison_id'];
            } else if ($li['factureavoir_id'] != 0) {
                $la = $la . ',' . $li['factureavoir_id'];
            } else if ($li['facturepublicitaire_id'] != 0) {
                $lpub = $lpub . ',' . $li['facturepublicitaire_id'];
            }
        }
        $l = $l . ',0)';
        $lb = $lb . ',0)';
        $la = $la . ',0)';
        $lpub = $lpub . ',0)';
        if ($cli != null) {
            $this->loadModel('Factureclients');
            $this->loadModel('Commandeclients');
            $this->loadModel('Clientpaiements');
            $factures = $this->Factureclients->find('all')->where(['Factureclients.projet_id =' . $project_id, 'Factureclients.totalttc > Factureclients.Montant_Regler OR Factureclients.id in ' . $l]);
            $livraisons = $this->Commandeclients->find('all')->where(['Commandeclients.client_id =' . $cli]);
            /* $mode = '(0';
            foreach ($livraisons as $fc) {
                //   $comm = $this->Commandeclients->find('all');/->where(['Commandeclients.factureclient_id =' . $fc->id]);
   
                   $paiementclients = $this->Clientpaiements->find('all')->where(['Clientpaiements.commandeclient_id =' . $fc->id]);
                  
                   foreach ($paiementclients as $pc) {
                       $mode .= ',' . $pc->paiement_id;
                   }
                   
               }
               $mode .= ')';
               $cond.='Paiements.id in '.$mode;
 */
        }
        //debug($cond);die;
        $this->loadModel('Paiements');
        $this->loadModel('Tos');
        $this->loadModel('Carnetcheques');
        $valeurs = $this->Tos->find('list', ['limit' => 200])->all();
        $paiements = $this->Paiements->find('list')->where([$cond])->all();
        $carnetcheques = $this->Carnetcheques->find('list', ['limit' => 200])->all();
        $connection = ConnectionManager::get('default');
        $listePaiements = $connection->execute("SELECT paiement_id FROM modalites WHERE client_id = $cli")->fetchAll('assoc');
        $paiementIds = array_column($listePaiements, 'paiement_id');
        $paiementNoms = [];
        if (!empty($paiementIds)) {
            $paiementNoms = $connection->execute("SELECT id, name FROM paiements /* WHERE id IN (" . implode(',', $paiementIds) . ")*/")->fetchAll('assoc');
        }
        $options = [];
        foreach ($paiementNoms as $paiement) {
            $options[$paiement['id']] = $paiement['name'];
        }
        $cha = "TRUE";
        $banques = $this->fetchTable('Banques')->find('list', ['keyField' => 'id', 'valueField' => 'name']);
        $banquesss = $this->fetchTable('Banques')->find('all');
        $clients = $this->Reglementclients->Clients->find('all');
        $importations = $this->Reglementclients->Importations->find('list', ['limit' => 200])->all();
        $utilisateurs = $this->Reglementclients->Utilisateurs->find('list', ['limit' => 200])->all();
        $exercices = $this->Reglementclients->Exercices->find('list', ['limit' => 200])->all();
        $devises = $this->Reglementclients->Devises->find('list', ['limit' => 200])->all();
        $reg_id = $id;
        $this->loadModel('Modalites');
        $modalites = $this->fetchTable('Modalites')->find('all', [
            'contain' => ['Paiements'],
        ])->where('Modalites.client_id =' . $cli);
        $this->set(compact('project_id', 'banques', 'banquesss', 'options', 'paiementNoms', 'paiementIds', 'listePaiements', 'modalites', 'reg_id', 'mtfact', 'mtbon', 'facreg', 'piecereglementclients', 'lignesreg', 'valeurs', 'carnetcheques', 'paiements', 'cli', 'livraisons', 'factures', 'reglement', 'clients', 'importations', 'utilisateurs', 'exercices', 'devises'));
    }
    public function viewregcli($id = null, $project_id = null)
    {
        $this->loadModel('Reglementclients');
        $this->loadModel('Factureclients');
        $this->loadModel('Bonlivraisons');
        $this->loadModel('Lignereglementclients');
        $this->loadModel('Piecereglementclients');
        $reglement = $this->Reglementclients->get($id, [
            'contain' => ['Projets', 'Clients'],
        ]);

        $cli = $reglement->client_id;
        $lignesreg = $this->Lignereglementclients->find('all')->where(['Lignereglementclients.reglementclient_id =' . $id]);
        // $piecereglementclients = $this->Piecereglementclients->find('all')->where(['Piecereglementclients.reglementclient_id =' . $id])->contain(['Paiements']);
        $piecereglementclients = $this->Piecereglementclients->find('all', ['contain' => ['Paiements']])
            ->where(['Piecereglementclients.reglementclient_id' => $id]);
        // ->contain(['Paiements']);

        $mtbon = 0.000;
        $mtfact = 0.000;
        foreach ($lignesreg as $k => $ligne) {
            if ($ligne['factureclient_id'] != null) {
                $facreg[$ligne['factureclient_id']] = 1;
                $mtfact = $mtfact + $ligne['Montant'];
            } else {
                $facreg[$ligne['bonlivraison_id']] = 1;
                $mtbon = $mtbon + $ligne['Montant'];
            }
        }
        if ($cli != null) {
            $this->loadModel('Factureclients');
            $this->loadModel('Commandeclients');
            $factures = $this->Factureclients->find('all')->where(['Factureclients.projet_id =' . $project_id, 'Factureclients.totalttc > Factureclients.Montant_Regler']);
            $livraisons = $this->Commandeclients->find('all')->where(['Commandeclients.client_id =' . $cli]);
        }
        $this->loadModel('Paiements');
        $this->loadModel('Carnetcheques');
        $this->loadModel('Tos');
        $valeurs = $this->Tos->find('list', ['limit' => 200])->all();
        $paiements = $this->Paiements->find('list', ['limit' => 200])->all();
        $carnetcheques = $this->Carnetcheques->find('list', ['limit' => 200])->all();
        $banques = $this->fetchTable('Banques')->find('list', ['keyField' => 'id', 'valueField' => 'name']);
        $cha = "TRUE";
        $clients = $this->Reglementclients->Clients->find('all');
        $importations = $this->Reglementclients->Importations->find('list', ['limit' => 200])->all();
        $utilisateurs = $this->Reglementclients->Utilisateurs->find('list', ['limit' => 200])->all();
        $exercices = $this->Reglementclients->Exercices->find('list', ['limit' => 200])->all();
        $devises = $this->Reglementclients->Devises->find('list', ['limit' => 200])->all();
        $this->set(compact('project_id', 'banques', 'id', 'mtfact', 'mtbon', 'facreg', 'piecereglementclients', 'lignesreg', 'valeurs', 'carnetcheques', 'paiements', 'cli', 'livraisons', 'factures', 'reglement', 'clients', 'importations', 'utilisateurs', 'exercices', 'devises'));
    }
    public function viewfaccli($id = null)
    {
        $this->loadModel('Factureclients');
        $this->loadModel('Personnels');

        // $factureclient = $this->Factureclients->get($id, [
        //     'contain' => ['Clients', 'Depots', 'Lignefactureclients'],
        // ]);
        $factureclient = $this->Factureclients->get($id, [
            'contain' => ['Lignefactureclients'],
        ]);
        $project_id = $factureclient->projet_id;
        if ($factureclient->bonlivraison_id) {
            $bonlivraison = $this->fetchTable('Bonlivraisons')->find('all', [
                'contain' => ['Commandes']
            ])
                ->where(['Bonlivraisons.id = ' . $factureclient->bonlivraison_id . '   ']);
        }
        $lignefactureclients = $this->Factureclients->Lignefactureclients->find('all', ['contain' => ['Articles']])->where(['factureclient_id' => $id, 'type=1']);
        $lignefactureclient2s = $this->Factureclients->Lignefactureclients->find('all', ['contain' => ['Articles']])->where(['factureclient_id' => $id, 'type=2']);
        $articles = $this->fetchTable('Articles')->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(['Articles.typearticle=1']);
        $articleservises = $this->fetchTable('Articles')->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(['Articles.typearticle=2']);
        $fournisseurs = $this->fetchTable('Fournisseurs')->find('list');

        $chauffeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 5 . "%' "]);
        $convoyeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 1 . "%' "]);
        $clients = $this->Factureclients->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'Raison_Sociale']);
        $chauffeurs = $this->Personnels->find('all')->where(["Personnels.fonction_id like  '%" . 5 . "%' "]);
        $conffaieurs = $this->Personnels->find('all')->where(["Personnels.fonction_id like  '%" . 1 . "%' "]);
        $clients = $this->Factureclients->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'Raison_Sociale']);
        $pointdeventes = $this->Factureclients->Pointdeventes->find('list', ['limit' => 200]);
        $depots = $this->Factureclients->Depots->find('list', ['limit' => 200]);
        $materieltransports = $this->Factureclients->Materieltransports->find('list', ['keyfield' => 'id', 'valueField' => 'matricule']);
        $cartecarburants = $this->Factureclients->Cartecarburants->find('list', ['limit' => 200]);
        $client_id = $factureclient->client_id;
        $incoterms = $this->fetchTable('Incoterms')->find('list', ['keyfield' => 'id', 'valueField' => 'code']);

        $tim = $this->fetchTable('Timbres')->find()->select([
            "timbre" =>
            'MAX(Timbres.timbre)'
        ])->first();
        $timbre = $tim->timbre;
        $adresselivraisonclients = $this->Factureclients->Adresselivraisonclients->find('list', ['keyfield' => 'id', 'valueField' => 'adresse'])->where(['client_id' => $client_id]);;

        $this->loadModel('Projets');
        $projets = $this->fetchTable('Projets')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $clientc = $this->fetchTable('Clients')->get($factureclient->client_id, [
            'contain' => []
        ]);
        $date = $factureclient->date;
        $date = $date->i18nFormat('yyyy-MM-dd');
        $BL = $clientc->bl;
        $unites = $this->fetchTable('Unites')->find('list');

        $this->set(compact('unites', 'fournisseurs', 'articleservises', 'lignefactureclient2s', 'project_id', 'BL', 'incoterms', 'projets', 'bonlivraison', 'timbre', 'clientc', 'factureclient', 'articlees', 'articles', 'lignefactureclients', 'clients', 'pointdeventes', 'depots', 'materieltransports', 'cartecarburants', 'chauffeurs', 'conffaieurs', 'adresselivraisonclients'));
    }
    public function editfaccli($id = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_vente' . $abrv);
        $factureclient = 0;
        foreach ($liendd as $k => $liens) {
            if (@$liens['lien'] == 'factureclients') {
                $factureclient = $liens['modif'];
            }
        }
        if (($factureclient <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $this->loadModel('Factureclients');
        // $factureclient = $this->Factureclients->get($id, [
        //     'contain' => ['Clients', 'Depots', 'Adresselivraisonclients'],
        // ]);
        $factureclient = $this->Factureclients->get($id, [
            'contain' => ['Adresselivraisonclients'],
        ]);
        //debug($factureclient);
        $project_id = $factureclient->projet_id;
        $this->loadModel('Personnels');
        $this->loadModel('Lignebonlivraisons');
        if ($factureclient->bonlivraison_id) {
            $bonlivraison = $this->fetchTable('Bonlivraisons')->find('all', [
                'contain' => ['Commandes']
            ])->where(['Bonlivraisons.id = ' . $factureclient->bonlivraison_id . '   ']);
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            $factureclient = $this->Factureclients->patchEntity($factureclient, $this->request->getData());
            if ($this->Factureclients->save($factureclient)) {
                $this->misejour("Factureclients", "edit", $id);
                $this->misejour("Factureclients", "editprojet", $project_id);

                $projet_id = $factureclient['projet_id'];
                $this->loadModel('Projets');
                $projet = $this->Projets->get($projet_id);
                $datetimeActuelle = FrozenTime::now();
                $datetimeActuelle->format('Y-m-d H:i:s');
                $projet->datemodification = $datetimeActuelle;
                $this->Projets->save($projet);
                if (isset($this->request->getData('data')['ligner']) && (!empty($this->request->getData('data')['ligner']))) {
                    foreach ($this->request->getData('data')['ligner'] as $i => $l) {
                        if ($l['sup0'] != 1) {
                            $tab['factureclient_id'] = $id;
                            $tab['article_id'] = $l['article_id'];
                            $tab['qte'] = $l['qte'];
                            $tab['prixht'] = $l['prixht'];
                            $tab['ttc'] = $l['ttc'];
                            $tab['fodec'] = $l['fodec'];
                            $tab['tva'] = $l['tva'];
                            $tab['punht'] = $l['punht'];
                            $tab['remise'] = $l['remise'];
                            $tab['fournisseur_id'] = $l['fournisseur_id'];
                            $tab['type'] = $l['type'];
                            $tab['description'] = $l['description'];
                            $tab['unite_id'] = $l['unite_id'];
                            $tab['tauxdemarque'] = $l['tauxdemarque'];
                            $tab['tauxdemarge'] = $l['tauxdemarge'];
                            if (isset($l['id']) && (!empty($l['id']))) {
                                $lignefactureclient = $this->fetchTable('Lignefactureclients')->get($l['id'], [
                                    'contain' => ['Articles']
                                ]);
                            } else {
                                $lignefactureclient = $this->fetchTable('Lignefactureclients')->newEmptyEntity();
                            };
                            $lignefactureclient = $this->fetchTable('Lignefactureclients')->patchEntity($lignefactureclient, $tab);
                            $this->fetchTable('Lignefactureclients')->save($lignefactureclient);
                        } else if (isset($l['id']) && (!empty($l['id']))) {
                            $lignefactureclient = $this->fetchTable('Lignefactureclients')->get($l['id']);
                            $this->fetchTable('Lignefactureclients')->delete($lignefactureclient);
                        }
                    }
                }
                return $this->redirect(['action' => 'editfaccli/', $id]);
            }
        }
        $lignefactureclients = $this->Factureclients->Lignefactureclients->find('all', ['contain' => ['Articles']])->where(['factureclient_id' => $id, 'type=1']);
        $lignefactureclient2s = $this->Factureclients->Lignefactureclients->find('all', ['contain' => ['Articles']])->where(['factureclient_id' => $id, 'type=2']);
        $articles = $this->fetchTable('Articles')->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(['Articles.typearticle=1']);
        $articleservises = $this->fetchTable('Articles')->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(['Articles.typearticle=2']);
        $fournisseurs = $this->fetchTable('Fournisseurs')->find('list');

        $chauffeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 5 . "%' "]);
        $convoyeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 1 . "%' "]);
        $clients = $this->Factureclients->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'Raison_Sociale']);
        $chauffeurs = $this->Personnels->find('all')->where(["Personnels.fonction_id like  '%" . 5 . "%' "]);
        $conffaieurs = $this->Personnels->find('all')->where(["Personnels.fonction_id like  '%" . 1 . "%' "]);
        $clients = $this->Factureclients->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'Raison_Sociale']);
        $pointdeventes = $this->Factureclients->Pointdeventes->find('list', ['limit' => 200]);
        $depots = $this->Factureclients->Depots->find('list', ['limit' => 200]);
        $materieltransports = $this->Factureclients->Materieltransports->find('list', ['keyfield' => 'id', 'valueField' => 'matricule']);
        $cartecarburants = $this->Factureclients->Cartecarburants->find('list', ['limit' => 200]);
        $client_id = $factureclient->client_id;
        $incoterms = $this->fetchTable('Incoterms')->find('list', ['keyfield' => 'id', 'valueField' => 'code']);

        $tim = $this->fetchTable('Timbres')->find()->select([
            "timbre" =>
            'MAX(Timbres.timbre)'
        ])->first();
        $timbre = $tim->timbre;
        $adresselivraisonclients = $this->Factureclients->Adresselivraisonclients->find('list', ['keyfield' => 'id', 'valueField' => 'adresse'])->where(['client_id' => $client_id]);;

        $this->loadModel('Projets');
        $projets = $this->fetchTable('Projets')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $clientc = $this->fetchTable('Clients')->get($factureclient->client_id, [
            'contain' => []
        ]);
        $date = $factureclient->date;
        $date = $date->i18nFormat('yyyy-MM-dd');
        $BL = $clientc->bl;
        $unites = $this->fetchTable('Unites')->find('list');

        $this->set(compact('unites', 'fournisseurs', 'articleservises', 'lignefactureclient2s', 'project_id', 'BL', 'incoterms', 'projets', 'bonlivraison', 'timbre', 'clientc', 'factureclient', 'articlees', 'articles', 'lignefactureclients', 'clients', 'pointdeventes', 'depots', 'materieltransports', 'cartecarburants', 'chauffeurs', 'conffaieurs', 'adresselivraisonclients'));
    }
    public function deletefaccli($id = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_vente' . $abrv);
        $factureclient = 0;
        foreach ($liendd as $k => $liens) {
            if (@$liens['lien'] == 'factureclients') {
                $factureclient = $liens['supp'];
            }
        }
        if (($factureclient <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        // $this->request->allowMethod(['post', 'delete']);
        $this->loadModel('Factureclients');
        $this->loadModel('Commandeclients');
        $commnadeclients = $this->Commandeclients->find('all')->where(['facture_id' => $id])->first();

        if (isset($commnadeclients) && !empty($commnadeclients)) {
            $commnadeclients->facture_id = null;
            $this->Commandeclients->save($commnadeclients);
        }
        $factureclient = $this->Factureclients->get($id);
        $project_id = $factureclient->projet_id;
        $this->misejour("Factureclients", "delete", $id);
        $projet_id = $factureclient['projet_id'];
        $this->loadModel('Projets');
        $projet = $this->Projets->get($projet_id);
        $datetimeActuelle = FrozenTime::now();
        $datetimeActuelle->format('Y-m-d H:i:s');
        $projet->datemodification = $datetimeActuelle;
        $this->Projets->save($projet);
        $this->loadModel('Lignefactureclients');
        $lignefactureclients = $this->fetchTable('Lignefactureclients')->find('all')
            ->where(['Lignefactureclients.factureclient_id=' . $id]);
        foreach ($lignefactureclients as $l) {
            $this->Lignefactureclients->delete($l);
        }
        if ($this->Factureclients->delete($factureclient)) {
            $this->misejour("Factureclients", "delete", $id);
        } else {
        }
        return $this->redirect(['action' => 'vieww/', $project_id]);
    }

    public function editconsultation($id = null, $id_dm = null, $projet_id = null)
    {
        // debug($projet_id);
        $id_projet = $projet_id;
        $this->loadModel('Demandeoffredeprixes');
        $this->loadModel('Lignedemandeoffredeprixes');
        $this->loadModel('Articles');
        $this->loadModel('Fournisseurs');
        $this->loadModel('Bandeconsultations');
        $this->loadModel('Lignebandeconsultations');
        $this->loadModel('Lignelignebandeconsultations');
        $this->loadModel('Paiements');
        $this->loadModel('Devises');
        $this->loadModel('Conditionreglements');
        $this->loadModel('Methodeexpeditions');


        $bandeconsultation = $this->Bandeconsultations->get($id, [
            'contain' => ['Lignebandeconsultations', 'Demandeoffredeprixes']
        ]);
        // debug($bandeconsultation);
        if ($this->request->is(['post', 'put'])) {
            // debug($this->request->getData());die;
            $data['demandeoffredeprix_id'] = $bandeconsultation->demandeoffredeprix_id;
            if (isset($this->request->getData('data')['fligne']) && (!empty($this->request->getData('data')['fligne']))) {
                foreach ($this->request->getData('data')['fligne'] as $j => $fourni) {
                    $data['fournisseur_id'] = $fourni['fournisseur_id'];
                    $data['nameF'] = $fourni['nameF'];
                    $data['t'] = $fourni['t'];
                    $data['devise_id'] = $fourni['devise_id'];
                    $data['conditionreglement_id'] = $fourni['conditionreglement_id'];
                    $data['methodeexpedition_id'] = $fourni['methodeexpedition_id'];
                    if (isset($this->request->getData('data')['fligne'][$j]['aligne']) && (!empty($this->request->getData('data')['fligne'][$j]['aligne']))) {
                        foreach ($this->request->getData('data')['fligne'][$j]['aligne'] as $i => $art) {
                            // debug($art);
                            $dataCopy = $data;
                            $dataCopy['article_id'] = $art['article_id'];
                            $dataCopy['designiationA'] = $art['designiationA'];
                            $dataCopy['qte'] = $art['qte'];
                            $dataCopy['prix'] = $art['prix'];
                            $dataCopy['totalprix'] = $art['total'];
                            // $ht=str_replace(',', '.', $art['total']);
                            $dataCopy['ht'] = $art['total'];
                            // debug($art['total']);
                            $dataCopy['lignedemandeoffredeprix_id'] = $art['ligne_id'];
                            $dataCopy['codefrs'] = $art['codefrs'];
                            $dataCopy['tauxdemarge'] = $art['tauxdemarge'];
                            $dataCopy['tauxdemarque'] = $art['tauxdemarque'];
                            $dataCopy['coutrevient'] = $art['coutrevient'];
                            $dataCopy['datelivraison'] = $art['datelivraison'];


                            $lignebande = $this->Lignebandeconsultations->find()
                                ->where([
                                    'Lignebandeconsultations.demandeoffredeprix_id' => $id_dm,
                                    'Lignebandeconsultations.nameF' => $fourni['nameF'],
                                    'Lignebandeconsultations.designiationA' => $art['designiationA'],
                                    'Lignebandeconsultations.lignedemandeoffredeprix_id' => $art['ligne_id']
                                ])
                                ->first();
                            // debug($lignebande);
                            if ($lignebande) {
                                //debug($dataCopy);//die;
                                $this->Lignebandeconsultations->patchEntity($lignebande, $dataCopy);

                                $this->Lignebandeconsultations->save($lignebande);
                                // debug($lignebande);die;
                            }
                        }
                    }
                    $lignelignebande = $this->Lignelignebandeconsultations->find()
                        ->where([
                            'Lignelignebandeconsultations.demandeoffredeprix_id' => $id_dm,
                            'Lignelignebandeconsultations.nameF' => $fourni['nameF']
                        ])
                        ->first();
                    if ($lignelignebande) {
                        $this->Lignelignebandeconsultations->patchEntity($lignelignebande, $data);
                        if ($this->Lignelignebandeconsultations->save($lignelignebande)) {
                            $this->fetchTable('Fournisseurpaiements')->deleteAll(['Fournisseurpaiements.lignelignebandeconsultation_id' => $lignelignebande->id]);
                            if (isset($fourni['paim']) && (!empty($fourni['paim'])) && ($fourni['paim'] != '')) {
                                $pieces = explode(", ", $fourni['paim']);

                                foreach ($pieces as $key => $piece) {
                                    $pp = $this->Paiements->find('all')->where(['Paiements.name ="' . $piece . '"'])->first();
                                    $fournisseurpaiement = $this->fetchTable('Fournisseurpaiements')->newEmptyEntity();
                                    $dattc['paiement_id'] = $pp['id'];
                                    $dattc['lignelignebandeconsultation_id'] = $lignelignebande->id;
                                    $fournisseurpaiement = $this->fetchTable('Fournisseurpaiements')->patchEntity($fournisseurpaiement, $dattc);
                                    $this->fetchTable('Fournisseurpaiements')->save($fournisseurpaiement);
                                }
                            }
                            if (isset($fourni['paiement_id']) && (!empty($fourni['paiement_id'])) && ($fourni['paiement_id'] != '')) {
                                $fournisseurpaiement = $this->fetchTable('Fournisseurpaiements')->newEmptyEntity();
                                $datc['paiement_id'] = $fourni['paiement_id'];
                                $datc['lignelignebandeconsultation_id'] = $lignelignebande->id;
                                $fournisseurpaiement = $this->fetchTable('Fournisseurpaiements')->patchEntity($fournisseurpaiement, $datc);
                                $this->fetchTable('Fournisseurpaiements')->save($fournisseurpaiement);
                            }
                        }
                        // debug($lignelignebande);
                    }
                }
            }
            $this->Bandeconsultations->patchEntity($bandeconsultation, $data);
            if ($this->Bandeconsultations->save($bandeconsultation)) {
                $this->misejour("Bandeconsultations ", "edit", $id);
                $this->misejour("Bandeconsultations ", "editprojet", $projet_id);
                $projet = $this->Projets->get($id_projet);
                $datetimeActuelle = FrozenTime::now();
                $datetimeActuelle->format('Y-m-d H:i:s');
                $projet->datemodification = $datetimeActuelle;
                $this->Projets->save($projet);

                //return $this->redirect(['action' => 'vieww', $id_projet]);
                return $this->redirect(['action' => 'editconsultation', $id, $id_dm, $projet_id]);
            }
        }
        $lignes = $this->Lignebandeconsultations->find('all')
            ->where(["Lignebandeconsultations.demandeoffredeprix_id ='" . $id_dm . "'"])->toArray();
        // debug($lignes);
        $ligneas = $this->Lignebandeconsultations->find('all', ['keyfield' => 'id', 'valueField' => 'designiationA'])
            ->group(["nomar" => '(Lignebandeconsultations.designiationA)', "id" => 'Lignebandeconsultations.id'])
            ->where(["Lignebandeconsultations.demandeoffredeprix_id ='" . $id_dm . "'"])->toArray();
        // debug($ligneas);
        // debug($id_dm);
        $lignefs = $this->Lignebandeconsultations->find('all', ['keyfield' => 'id', 'valueField' => 'nameF'])
            ->group(["nomfour" => '(Lignebandeconsultations.nameF)'])
            ->where(["Lignebandeconsultations.demandeoffredeprix_id  ='" . $id_dm . "'"])->toArray();
        // debug($lignefs);
        $fournisseurs = $this->Fournisseurs->find('list');
        $demandes = $this->Bandeconsultations->find()
            ->select(["dm" => '(Bandeconsultations.id)'])
            ->where(["Bandeconsultations.id ='" . $id . "'"])->first();
        // debug($demandes);
        $articles = $this->Articles->find('list', array('fields' => array('Articles.designiation')));
        $paiements = $this->Paiements->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $devises = $this->Devises->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $conditionreglements = $this->Conditionreglements->find('list', ['keyfield' => 'id', 'valueField' => 'conditionn']);
        $methodeexpeditions = $this->Methodeexpeditions->find('list', ['keyfield' => 'id', 'valueField' => 'methode']);
        $this->set(compact('paiements', 'devises', 'conditionreglements', 'methodeexpeditions', 'id_dm', 'articles', 'demandes', 'fournisseurs', 'ligneas', 'lignefs', 'bandeconsultation', 'typeof', 'projet_id', 'id_projet'));
    }
    public function imprimeviewbande0803($id = null)
    {
        $this->loadModel('Bandeconsultations');
        debug($id);
        $bandeconsultation = $this->Bandeconsultations->get(2, [
            'contain' => []
        ]);
        debug($bandeconsultation);
        $this->loadModel('Demandeoffredeprixes');
        $this->loadModel('Lignedemandeoffredeprixes');
        $this->loadModel('Articles');
        $this->loadModel('Fournisseurs');
        $this->loadModel('Bandeconsultations');
        $this->loadModel('Lignebandeconsultations');
        $this->loadModel('Lignelignebandeconsultations');
        if (!$this->Bandeconsultations->exists($id)) {
            throw new NotFoundException(__('Invalid demandeoffredeprix'));
        }

        // $demandeoffredeprix = $this->Bandeconsultations->get($id, [
        //     'contain' => []
        // ]);

        $lignefs = $this->Lignebandeconsultations->find('all', ['keyfield' => 'id', 'valueField' => 'nameF'])
            ->group(["nomfour" => '(Lignebandeconsultations.nameF)'])
            ->where(["Lignebandeconsultations.bandeconsultation_id=" . $id]);
        // debug($lignefs->toArray());die;
        $fournisseurs = $this->Fournisseurs->find('list');
        $demandes = $this->Demandeoffredeprixes->find()
            ->select(["dm" => '(Demandeoffredeprixes.id)'])
            ->where(["Demandeoffredeprixes.id ='" . $id . "'"])->first();
        $type = $this->Demandeoffredeprixes->find()
            ->select(["typeoffredeprix" => '(Demandeoffredeprixes.typeoffredeprix)'])
            ->where(["Demandeoffredeprixes.id ='" . $id . "'"])->first();
        $typedem = $type['typeoffredeprix'];
        $articles = $this->Articles->find('list', array('fields' => array('Articles.designiation')));
        $ligneas = $this->Lignebandeconsultations->find('all', ['keyfield' => 'id', 'valueField' => 'designiationA'])
            ->group(["nomar" => '(Lignebandeconsultations.designiationA)'])
            ->where(["Lignebandeconsultations.bandeconsultation_id =" . $id]);

        $this->set(compact('articles', 'demandes', 'typedem', 'fournisseurs', 'ligneas', 'lignefs', 'demandeoffredeprix', 'project_id'));
    }
    public function imprimeviewbande00($id = null, $id_dm = null)
    {
        // debug($id);
        error_reporting(E_ERROR | E_PARSE);
        $this->loadModel('Demandeoffredeprixes');
        $this->loadModel('Lignedemandeoffredeprixes');
        $this->loadModel('Articles');
        $this->loadModel('Fournisseurs');
        $this->loadModel('Bandeconsultations');
        $this->loadModel('Lignebandeconsultations');
        $this->loadModel('Lignelignebandeconsultations');
        $bandeconsultation = $this->Bandeconsultations->get($id, [
            'contain' => []
        ]);
        $ligneas = $this->Lignebandeconsultations->find('all', ['keyfield' => 'id', 'valueField' => 'designiationA'])
            ->group(["nomar" => '(Lignebandeconsultations.designiationA)', "id" => 'Lignebandeconsultations.id'])
            ->where(["Lignebandeconsultations.demandeoffredeprix_id ='" . $id_dm . "'"])->toArray();
        // debug($ligneas);
        $lignefs = $this->Lignebandeconsultations->find('all', ['keyfield' => 'id', 'valueField' => 'nameF'])
            ->group(["nomfour" => '(Lignebandeconsultations.nameF)'])
            ->where(["Lignebandeconsultations.demandeoffredeprix_id  ='" . $id_dm . "'"])->toArray();
        $groupedResults = [];
        $fournisseurss = $this->Fournisseurs->find('list');
        $fournisseurs = $this->Lignebandeconsultations->find('all', ['keyfield' => 'id', 'valueField' => 'nameF'])
            ->group(["namef" => '(Lignebandeconsultations.nameF)'])
            ->where(["Lignebandeconsultations.demandeoffredeprix_id  ='" . $id_dm . "'"]);
        $articles = $this->Bandeconsultations->find('all', ['keyfield' => 'id', 'valueField' => 'designiationA'])
            ->group(["art" => '(Bandeconsultations.designiationA)'])
            ->where(["Bandeconsultations.demandeoffredeprix_id = '" . $id_dm . "'"]);
        $tab = array();
        $tab1 = array();
        foreach ($fournisseurs as $frs) {
            //debug($frs);
            $idfrs = $frs['fournisseur_id'];
            $namefrs = $frs['nameF'];
            //echo($namefrs);die;
            foreach ($articles as $art) {
                //debug($art);die;
                //  $idart = $art['article_id'];
                $idart = $art['article_id'];
                $iddemande = $art['demandeoffredeprix_id'];
                $artdes = $art['designiationA']; {
                    $pr = $this->Lignebandeconsultations->find('all')
                        ->select(["ht" => '(Lignebandeconsultations.prix)'])
                        //->where(["Lignebandeconsultations.nameF = '" . $namefrs . "'"])
                        ->where(["Lignebandeconsultations.demandeoffredeprix_id = '" . $iddemande . "'"])
                        ->where(["Lignebandeconsultations.designiationA = '" . $artdes . "'"])
                        ->order(["Lignebandeconsultations.prix"]);
                    $donnes = $this->Lignebandeconsultations->find()
                        // ->group(["nomfour" => '(Lignebandeconsultations.nameF)'])
                        ->where(["Lignebandeconsultations.nameF = '" . $namefrs . "'"])
                        ->where(["Lignebandeconsultations.demandeoffredeprix_id  = '" . $iddemande . "'"])
                        ->where(["Lignebandeconsultations.designiationA = '" . $artdes . "'"]);
                    // debug($donnes->toArray());die;
                }
                $tab[$namefrs][$artdes] = $donnes;
                $tab1[$namefrs][$artdes] = $pr;
                // debug($tab1);
            }
        }
        $demandes = $this->Bandeconsultations->find()
            ->select(["dm" => '(Bandeconsultations.id)'])
            ->where(["Bandeconsultations.id ='" . $id . "'"])->first();
        $articless = $this->Articles->find('list', array('fields' => array('Articles.designiation')));
        $this->set(compact('articles', 'tab', 'tab1', 'demandes', 'fournisseurs', 'ligneas', 'lignefs', 'bandeconsultation', 'typeof'));
    }

    public function imprimecommande($id = null)
    {
        // debug($id);
        // print_r($id);
        //Configure::write('debug', true);
        // debug($id);
        $this->loadModel('Demandeoffredeprixes');
        $this->loadModel('Commandefournisseurs');
        $commandefournisseur = $this->Commandefournisseurs->get($id, [
            'contain' => [
                'Fournisseurs',
                'Incoterms' => ['strategy' => 'select'],
                'Devises' => ['strategy' => 'select']
            ]
        ]);
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

        $domainName = $_SERVER['HTTP_HOST'];
        $requestUri = $_SERVER['REQUEST_URI'];
        $segments = explode('/', trim($requestUri, '/')); // Découpe l'URL en segments

        $baseSegment = isset($segments[0]) ? '/' . $segments[0]  : '/';

        $wr = $protocol . $domainName . $baseSegment;
        // debug($commandefournisseur);
        $fournisseurs = $this->Commandefournisseurs->Fournisseurs->find('list', ['limit' => 200]);
        $this->loadModel('Lignecommandefournisseurs');
        $lignecommandefournisseurs = $this->Lignecommandefournisseurs->find('all')->contain(['Articles'])->where(["Lignecommandefournisseurs.commandefournisseur_id=" . $id . " "]);
        //debug($lignecommandeclients);
        $this->loadModel('Articles');
        $articles = $this->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'designiation']);
        $commandefournisseurs = $this->Commandefournisseurs->find('all')->contain(['Fournisseurs']);
        // debug($commandefournisseur['fournisseur_id']);
        if ($commandefournisseur['fournisseur_id']) {
            $fournisseur = $this->Commandefournisseurs->Fournisseurs->get($commandefournisseur['fournisseur_id'], [
                'contain' => []
            ]);
            if ($fournisseur->logo) {
                $logo = str_replace('%20', ' ', $fournisseur->logo);
                $extension = pathinfo($logo, PATHINFO_EXTENSION);
                $extensionWithoutDot = ltrim($extension, '.');
                if ($extensionWithoutDot == 'jpg') {
                    $extensionWithoutDot = 'jpeg';
                }
                $img = file_get_contents(
                    $wr . '/webroot/img/logofournisseurs/' . $logo . ''
                );

                if ($img !== false) {
                    $data = base64_encode($img);
                } else {
                    $imggg = file_get_contents(
                        $wr . '/img/logo.png'
                    );
                    $data = base64_encode($imggg);
                    $extensionWithoutDot = 'png';
                }
            } else {
                $imggg = file_get_contents(
                    $wr . '/img/logo.png'
                );
                $data = base64_encode($imggg);
                $extensionWithoutDot = 'png';
            }
        }

        //  debug($fournisseur);
        // debug($fournisseur);


        //$data = base64_encode($img);
        $img2 = file_get_contents(
            $wr . '/img/SGS.png'
        );

        $data2 = base64_encode($img2);
        // debug($commandefournisseur['demandeoffredeprix_id']);
        $dopnum = $this->Demandeoffredeprixes->find('list', ['keyfield' => 'id', 'valueField' => 'numero'])
            ->where(["Demandeoffredeprixes.id  ='" . $commandefournisseur['demandeoffredeprix_id'] . "'"]);
        //debug($dopnum);
        $tab1 = array();
        foreach ($dopnum as $tab1) {
        }
        $societe = $this->fetchTable('Societes')->find('all')
            ->where(['id' => 1])->first();
        $societes = $this->fetchTable('Societes')->find('all')->first();
        $this->set(compact('extensionWithoutDot', 'data', 'fournisseur', 'societes', 'lignecommandefournisseurs', 'tab1', 'articles', 'commandefournisseur', 'fournisseurs'));
    }
    public function imprimecommandeee($id = null)
    {
        // debug($id);
        // print_r($id);
        //Configure::write('debug', true);
        // debug($id);
        $this->loadModel('Demandeoffredeprixes');
        $this->loadModel('Commandefournisseurs');
        $commandefournisseur = $this->Commandefournisseurs->get($id, [
            'contain' => [
                'Fournisseurs',
                'Incoterms' => ['strategy' => 'select'],
                'Devises' => ['strategy' => 'select']
            ]
        ]);
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

        $domainName = $_SERVER['HTTP_HOST'];
        $requestUri = $_SERVER['REQUEST_URI'];
        $segments = explode('/', trim($requestUri, '/')); // Découpe l'URL en segments

        $baseSegment = isset($segments[0]) ? '/' . $segments[0]  : '/';

        $wr = $protocol . $domainName . $baseSegment;
        // debug($commandefournisseur);
        $fournisseurs = $this->Commandefournisseurs->Fournisseurs->find('list', ['limit' => 200]);
        $this->loadModel('Lignecommandefournisseurs');
        $lignecommandefournisseurs = $this->Lignecommandefournisseurs->find('all')->contain(['Articles'])->where(["Lignecommandefournisseurs.commandefournisseur_id=" . $id . " "]);
        //debug($lignecommandeclients);
        $this->loadModel('Articles');
        $articles = $this->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'designiation']);
        $commandefournisseurs = $this->Commandefournisseurs->find('all')->contain(['Fournisseurs']);
        // debug($commandefournisseur['fournisseur_id']);
        if ($commandefournisseur['fournisseur_id']) {
            $fournisseur = $this->Commandefournisseurs->Fournisseurs->get($commandefournisseur['fournisseur_id'], [
                'contain' => []
            ]);
            if ($fournisseur->logo) {
                $logo = str_replace('%20', ' ', $fournisseur->logo);
                $extension = pathinfo($logo, PATHINFO_EXTENSION);
                $extensionWithoutDot = ltrim($extension, '.');
                if ($extensionWithoutDot == 'jpg') {
                    $extensionWithoutDot = 'jpeg';
                }
                $img = file_get_contents(
                    $wr . '/webroot/img/logofournisseurs/' . $logo . ''
                );

                if ($img !== false) {
                    $data = base64_encode($img);
                } else {
                    $imggg = file_get_contents(
                        $wr . '/img/logo.png'
                    );
                    $data = base64_encode($imggg);
                    $extensionWithoutDot = 'png';
                }
            } else {
                $imggg = file_get_contents(
                    $wr . '/img/logo.png'
                );
                $data = base64_encode($imggg);
                $extensionWithoutDot = 'png';
            }
        }

        //  debug($fournisseur);
        // debug($fournisseur);


        //$data = base64_encode($img);
        $img2 = file_get_contents(
            $wr . '/img/SGS.png'
        );

        $data2 = base64_encode($img2);
        // debug($commandefournisseur['demandeoffredeprix_id']);
        $dopnum = $this->Demandeoffredeprixes->find('list', ['keyfield' => 'id', 'valueField' => 'numero'])
            ->where(["Demandeoffredeprixes.id  ='" . $commandefournisseur['demandeoffredeprix_id'] . "'"]);
        //debug($dopnum);
        $tab1 = array();
        foreach ($dopnum as $tab1) {
        }
        $societe = $this->fetchTable('Societes')->find('all')
            ->where(['id' => 1])->first();
        $societes = $this->fetchTable('Societes')->find('all')->first();
        $this->set(compact('extensionWithoutDot', 'id', 'data', 'fournisseur', 'societes', 'lignecommandefournisseurs', 'tab1', 'articles', 'commandefournisseur', 'fournisseurs'));
    }

    public function imprimefactclient($id = null)
    {
        $this->loadModel('Factureclients');
        // $commandeclient = $this->Commandeclients->get($id, [
        //     'contain' => ['Lignecommandeclients', 'Clients', 'Projets', 'Incoterms', 'Devises'],
        // ]);
        $commandeclient = $this->Factureclients->get($id, [
            'contain' => ['Adresselivraisonclients', 'Clients'],
        ]);
        //debug($factureclient);
        $project_id = $commandeclient->projet_id;
        $this->loadModel('Personnels');
        $this->loadModel('Lignebonlivraisons');
        if ($commandeclient->bonlivraison_id) {
            $bonlivraison = $this->fetchTable('Bonlivraisons')->find('all', [
                'contain' => ['Commandes']
            ])->where(['Bonlivraisons.id = ' . $commandeclient->bonlivraison_id . '   ']);
        }

        $chauffeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 5 . "%' "]);
        $convoyeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 1 . "%' "]);
        $clients = $this->Factureclients->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'Raison_Sociale']);
        $chauffeurs = $this->Personnels->find('all')->where(["Personnels.fonction_id like  '%" . 5 . "%' "]);
        $conffaieurs = $this->Personnels->find('all')->where(["Personnels.fonction_id like  '%" . 1 . "%' "]);
        $clients = $this->Factureclients->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'Raison_Sociale']);
        $pointdeventes = $this->Factureclients->Pointdeventes->find('list', ['limit' => 200]);
        $depots = $this->Factureclients->Depots->find('list', ['limit' => 200]);
        $materieltransports = $this->Factureclients->Materieltransports->find('list', ['keyfield' => 'id', 'valueField' => 'matricule']);
        $cartecarburants = $this->Factureclients->Cartecarburants->find('list', ['limit' => 200]);
        $client_id = $commandeclient->client_id;
        $incoterms = $this->fetchTable('Incoterms')->find('list', ['keyfield' => 'id', 'valueField' => 'code']);

        $tim = $this->fetchTable('Timbres')->find()->select([
            "timbre" =>
            'MAX(Timbres.timbre)'
        ])->first();
        $timbre = $tim->timbre;
        $adresselivraisonclients = $this->Factureclients->Adresselivraisonclients->find('list', ['keyfield' => 'id', 'valueField' => 'adresse'])->where(['client_id' => $client_id]);;
        $this->loadModel('Articles');
        $articles = $this->fetchTable('Articles')->find('all');
        $this->loadModel('Projets');
        $projets = $this->fetchTable('Projets')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $clientc = $this->fetchTable('Clients')->get($commandeclient->client_id, [
            'contain' => []
        ]);
        $date = $commandeclient->date;
        $date = $date->i18nFormat('yyyy-MM-dd');
        $BL = $clientc->bl;
        $clients = $this->fetchTable('Clients')->find('list', ['keyfield' => 'id', 'valueField' => 'nom']);
        $pointdeventes = $this->Factureclients->Pointdeventes->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $depots = $this->Factureclients->Depots->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $this->loadModel('Lignecommandeclients');
        //$lignecommandeclients = $this->Factureclients->Lignecommandeclients->find('all')->where(["Lignecommandeclients.commandeclient_id=" . $id . " "]);
        $this->loadModel('Articles');
        $lignecommandeclients = $this->Factureclients->Lignefactureclients->find('all', [
            'contain' => ['Articles']
        ])
            ->where(['factureclient_id' => $id, 'type' => 1]);
        $connection = ConnectionManager::get('default');

        $lignecommandeclient2s = $connection->execute("SELECT lc.* FROM lignefactureclients lc INNER JOIN ( SELECT article_id, MAX(prixht) AS max_price FROM lignefactureclients WHERE lignefactureclients.type=2 and factureclient_id='" . $id . "' GROUP BY article_id) AS max_prices ON lc.article_id = max_prices.article_id AND lc.prixht = max_prices.max_price WHERE lc.factureclient_id='" . $id . "'")->fetchAll('assoc');

        $societes = $this->fetchTable('Societes')->find('all')->first();
        $this->set(compact('lignecommandeclients', 'societes', 'articles', 'commandeclient', 'clients', 'pointdeventes', 'depots'));
    }
    public function imprimefactclientt($id = null)
    {
        $this->loadModel('Factureclients');
        // $commandeclient = $this->Commandeclients->get($id, [
        //     'contain' => ['Lignecommandeclients', 'Clients', 'Projets', 'Incoterms', 'Devises'],
        // ]);
        $commandeclient = $this->Factureclients->get($id, [
            'contain' => ['Clients', 'Devises'],
        ]);
        // debug($commandeclient);die;
        $project_id = $commandeclient->projet_id;
        $this->loadModel('Personnels');
        $this->loadModel('Lignebonlivraisons');
        if ($commandeclient->bonlivraison_id) {
            $bonlivraison = $this->fetchTable('Bonlivraisons')->find('all', [
                'contain' => ['Commandes']
            ])->where(['Bonlivraisons.id = ' . $commandeclient->bonlivraison_id . '   ']);
        }

        $chauffeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 5 . "%' "]);
        $convoyeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 1 . "%' "]);
        $clients = $this->Factureclients->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'Raison_Sociale']);
        $chauffeurs = $this->Personnels->find('all')->where(["Personnels.fonction_id like  '%" . 5 . "%' "]);
        $conffaieurs = $this->Personnels->find('all')->where(["Personnels.fonction_id like  '%" . 1 . "%' "]);
        $clients = $this->Factureclients->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'Raison_Sociale']);
        $pointdeventes = $this->Factureclients->Pointdeventes->find('list', ['limit' => 200]);
        $depots = $this->Factureclients->Depots->find('list', ['limit' => 200]);
        $materieltransports = $this->Factureclients->Materieltransports->find('list', ['keyfield' => 'id', 'valueField' => 'matricule']);
        $cartecarburants = $this->Factureclients->Cartecarburants->find('list', ['limit' => 200]);
        $client_id = $commandeclient->client_id;
        $incoterms = $this->fetchTable('Incoterms')->find('list', ['keyfield' => 'id', 'valueField' => 'code']);

        $tim = $this->fetchTable('Timbres')->find()->select([
            "timbre" =>
            'MAX(Timbres.timbre)'
        ])->first();
        $timbre = $tim->timbre;
        $adresselivraisonclients = $this->Factureclients->Adresselivraisonclients->find('list', ['keyfield' => 'id', 'valueField' => 'adresse'])->where(['client_id' => $client_id]);;
        $this->loadModel('Articles');
        $articles = $this->fetchTable('Articles')->find('all');
        $this->loadModel('Projets');
        $projets = $this->fetchTable('Projets')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $clientc = $this->fetchTable('Clients')->get($commandeclient->client_id, [
            'contain' => []
        ]);
        $date = $commandeclient->date;
        $date = $date->i18nFormat('yyyy-MM-dd');
        $BL = $clientc->bl;
        $clients = $this->fetchTable('Clients')->find('list', ['keyfield' => 'id', 'valueField' => 'nom']);
        $pointdeventes = $this->Factureclients->Pointdeventes->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $depots = $this->Factureclients->Depots->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $this->loadModel('Lignecommandeclients');
        //$lignecommandeclients = $this->Factureclients->Lignecommandeclients->find('all')->where(["Lignecommandeclients.commandeclient_id=" . $id . " "]);
        $this->loadModel('Articles');
        $lignecommandeclients = $this->Factureclients->Lignefactureclients->find('all', [
            'contain' => ['Articles']
        ])
            ->where(['factureclient_id' => $id/* , 'type' => 1 */]);
        $connection = ConnectionManager::get('default');

        $lignecommandeclient2s = $connection->execute("SELECT lc.* FROM lignefactureclients lc INNER JOIN ( SELECT article_id, MAX(prixht) AS max_price FROM lignefactureclients WHERE lignefactureclients.type=2 and factureclient_id='" . $id . "' GROUP BY article_id) AS max_prices ON lc.article_id = max_prices.article_id AND lc.prixht = max_prices.max_price WHERE lc.factureclient_id='" . $id . "'")->fetchAll('assoc');

        $societes = $this->fetchTable('Societes')->find('all')->first();
        $this->loadModel('Lignecommandeclients');
        //Configure::write('debug', true);
        $total_transportt2 = 0;
        if ($commandeclient['commandeclient_id']) {
            $lignecommandeclientype2s = $this->Lignecommandeclients->find('all')->select(['transport' => 'sum(Lignecommandeclients.ttc)'])->where(["Lignecommandeclients.commandeclient_id=" . $commandeclient['commandeclient_id'] . " ", "Lignecommandeclients.type=2"])->first();
            //debug($lignecommandeclientype2s);
            $total_transportt2 = $lignecommandeclientype2s['transport'];
        }
        $lignecommandeclient2s = $connection->execute("SELECT lc.* FROM lignefactureclients lc WHERE description!='' and description is not null and lc.type=2 and lc.factureclient_id='" . $id . "'")->fetch('assoc');

        //var_dump($lignecommandeclient2s[0]['description']) ;
        $this->set(compact('lignecommandeclients', 'total_transportt2', 'lignecommandeclient2s', 'id', 'societes', 'articles', 'commandeclient', 'clients', 'pointdeventes', 'depots'));
    }
    public function imprimerview($id = null)
    {
        $this->loadModel('Commandeclients');
        $commandeclient = $this->Commandeclients->get($id, [
            'contain' => ['Conditionreglements', 'Delailivraisons', 'Methodeexpeditions', 'Lignecommandeclients', 'Clients', 'Projets', 'Incoterms', 'Devises'],
        ]);
        $clients = $this->fetchTable('Clients')->find('list', ['keyfield' => 'id', 'valueField' => 'nom']);
        $pointdeventes = $this->Commandeclients->Pointdeventes->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $depots = $this->Commandeclients->Depots->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $this->loadModel('Lignecommandeclients');
        $connection = ConnectionManager::get('default');

        $lignecommandeclients = $this->Commandeclients->Lignecommandeclients->find('all')->where(["Lignecommandeclients.commandeclient_id=" . $id . " "]);
        $lignecommandeclient2s = $connection->execute("SELECT lc.* FROM lignecommandeclients lc INNER JOIN ( SELECT article_id, MAX(prixht) AS max_price FROM lignecommandeclients WHERE lignecommandeclients.type=2 and commandeclient_id='" . $id . "' GROUP BY article_id) AS max_prices ON lc.article_id = max_prices.article_id AND lc.prixht = max_prices.max_price WHERE lc.commandeclient_id='" . $id . "'")->fetchAll('assoc');

        // debug($lignecommandeclient2s);die;
        $projet = $this->Projets->find('all', [
            'contain' => ['Devises'],
        ])->where(["Projets.id=" . $commandeclient->projet_id . " "])->first();

        $this->loadModel('Articles');
        $articles = $this->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation']);
        $societes = $this->fetchTable('Societes')->find('all')->first();
        if ($commandeclient->projet_id != null) {
            $projeet = $this->fetchTable('Projets')->find('all', [
                'contain' => ['Devises'],
            ])->where(['Projets.id=' . $commandeclient->projet_id])->first();
            debug($commandeclient);
            if ($projeet['banque_id'] && $commandeclient['devis_id']) {
                $comptebanq = $this->fetchTable('ComptesBank')->find('all')->where(['ComptesBank.banque_id=' . $projeet['banque_id'], 'ComptesBank.devise_id=' . $commandeclient['devis_id']])->first();
                // $banquee = $connection->execute("SELECT compte FROM comptesBank WHERE id = '" . $projet[0]['comptesBank_id'] . "'")->fetchAll('assoc');
                $compbanq = $comptebanq['compte'];
            }
        }
        $this->set(compact('projet', 'lignecommandeclient2s', 'compbanq', 'lignecommandeclients', 'societes', 'articles', 'commandeclient', 'clients', 'pointdeventes', 'depots'));
    }

    public function imprimerview1($id = null)
    {
        $this->loadModel('Commandeclients');
        $commandeclient = $this->Commandeclients->get($id, [
            'contain' => ['Conditionreglements', 'Delailivraisons', 'Methodeexpeditions', 'Lignecommandeclients', 'Clients', 'Projets', 'Incoterms', 'Devises'],
        ]);
        $clients = $this->fetchTable('Clients')->find('list', ['keyfield' => 'id', 'valueField' => 'nom']);
        $pointdeventes = $this->Commandeclients->Pointdeventes->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $depots = $this->Commandeclients->Depots->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $this->loadModel('Lignecommandeclients');
        $connection = ConnectionManager::get('default');

        $lignecommandeclients = $this->Commandeclients->Lignecommandeclients->find('all')->where(["Lignecommandeclients.commandeclient_id=" . $id . " "]);
        $lignecommandeclient2s = $connection->execute("SELECT lc.* FROM lignecommandeclients lc INNER JOIN ( SELECT article_id, MAX(prixht) AS max_price FROM lignecommandeclients WHERE lignecommandeclients.type=2 and commandeclient_id='" . $id . "' GROUP BY article_id) AS max_prices ON lc.article_id = max_prices.article_id AND lc.prixht = max_prices.max_price WHERE lc.commandeclient_id='" . $id . "'")->fetchAll('assoc');

        // debug($lignecommandeclient2s);die;
        $projet = $this->Projets->find('all', [
            'contain' => ['Devises'],
        ])->where(["Projets.id=" . $commandeclient->projet_id . " "])->first();

        $this->loadModel('Articles');
        $articles = $this->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation']);
        $societes = $this->fetchTable('Societes')->find('all')->first();
        if ($commandeclient->projet_id != null) {
            $projeet = $this->fetchTable('Projets')->find('all', [
                'contain' => ['Devises'],
            ])->where(['Projets.id=' . $commandeclient->projet_id])->first();
            debug($commandeclient);
            if ($projeet['banque_id'] && $commandeclient['devis_id']) {
                $comptebanq = $this->fetchTable('ComptesBank')->find('all')->where(['ComptesBank.banque_id=' . $projeet['banque_id'], 'ComptesBank.devise_id=' . $commandeclient['devis_id']])->first();
                // $banquee = $connection->execute("SELECT compte FROM comptesBank WHERE id = '" . $projet[0]['comptesBank_id'] . "'")->fetchAll('assoc');
                $compbanq = $comptebanq['compte'];
            }
        }
        $this->set(compact('projet', 'id', 'lignecommandeclient2s', 'compbanq', 'lignecommandeclients', 'societes', 'articles', 'commandeclient', 'clients', 'pointdeventes', 'depots'));
    }
    public function viewboncommandecli($id = null)
    {
        $this->loadModel('Commandeclients');
        $this->loadModel('Personnels');
        $commandeclient = $this->Commandeclients->get($id, [
            'contain' => ['Lignecommandeclients'],
        ]);
        //var_dump($commandeclient);die;
        $project_id = $commandeclient->projet_id;

        $this->loadModel('Clients');
        $this->loadModel('Projets');
        $projets = $this->fetchTable('Projets')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $clients = $this->fetchTable('Clients')->find('list', ['keyfield' => 'id', 'valueField' => 'nom']);
        $chauffeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 5 . "%' "]);
        $convoyeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 1 . "%' "]);
        $pointdeventes = $this->Commandeclients->Pointdeventes->find('list', ['limit' => 200]);
        $depots = $this->Commandeclients->Depots->find('list', ['limit' => 200]);
        $cartecarburants = $this->Commandeclients->Cartecarburants->find('list', ['limit' => 200]);
        $materieltransports = $this->Commandeclients->Materieltransports->find('list', ['limit' => 200]);
        $bonlivraisons = $this->Commandeclients->Bonlivraisons->find('list', ['limit' => 200]);
        $this->loadModel('Lignecommandeclients');
        // $lignecommandeclients = $this->Commandeclients->Lignecommandeclients->find('all')->where(["Lignecommandeclients.commandeclient_id=" . $id . " "]);
        $connection = ConnectionManager::get('default');
        $lignecommandeclients = $connection->execute("SELECT lc.* FROM lignecommandeclients lc INNER JOIN ( SELECT article_id, MAX(prixht) AS max_price FROM lignecommandeclients WHERE lignecommandeclients.type=1 and commandeclient_id='" . $id . "' GROUP BY article_id) AS max_prices ON lc.article_id = max_prices.article_id AND lc.prixht = max_prices.max_price WHERE lc.commandeclient_id='" . $id . "'")->fetchAll('assoc');
        $lignecommandeclient2s = $connection->execute("SELECT lc.* FROM lignecommandeclients lc INNER JOIN ( SELECT article_id, MAX(prixht) AS max_price FROM lignecommandeclients WHERE lignecommandeclients.type=2 and commandeclient_id='" . $id . "' GROUP BY article_id) AS max_prices ON lc.article_id = max_prices.article_id AND lc.prixht = max_prices.max_price WHERE lc.commandeclient_id='" . $id . "'")->fetchAll('assoc');
        $lignecommandeclients = $this->Commandeclients->Lignecommandeclients->find('all')->where(["Lignecommandeclients.commandeclient_id=" . $id, "Lignecommandeclients.type=1"]);
        $lignecommandeclient2s = $this->Commandeclients->Lignecommandeclients->find('all')->where(["Lignecommandeclients.commandeclient_id=" . $id, "Lignecommandeclients.type=2"]);
        $this->loadModel('Articles');
        $articles = $this->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Articles.vente = 1"]);
        $devises = $this->fetchTable('Devises')->find('list', [
            'keyfield' => 'id',
            'valueField' => function ($d) {
                return $d->name . ' (' . $d->symbole . ')';
            }
        ]);
        $incoterms = $this->fetchTable('Incoterms')->find('list', ['keyfield' => 'id', 'valueField' => 'code']);
        $parametretaus = $this->fetchTable('Parametretaus')->find('all')->first();
        $typeremises['1'] = "%";
        $typeremises['2'] = "Valeur";
        $this->set(compact('parametretaus', 'lignecommandeclient2s', 'typeremises', 'project_id', 'devises', 'incoterms', 'lignecommandeclients', 'articles', 'commandeclient', 'clients', 'projets', 'depots', 'cartecarburants', 'materieltransports', 'chauffeurs', 'convoyeurs', 'bonlivraisons'));
    }
    public function deletecomclient($id = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_vente' . $abrv);
        $commandesclients = 0;
        foreach ($liendd as $k => $liens) {
            if (@$liens['lien'] == 'commandesclients') {
                $commandesclients = $liens['supp'];
            }
        }
        if (($commandesclients <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $this->loadModel('Commandeclients');
        // $this->request->allowMethod(['post', 'delete']);
        $commandeclient = $this->Commandeclients->get($id);

        $commandeclient->valider = 0;
        $this->Commandeclients->save($commandeclient);
        $project_id = $commandeclient->projet_id;

        return $this->redirect(['action' => 'vieww/', $project_id]);
    }
    public function deletecomcli($id = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_vente' . $abrv);
        $commandesclients = 0;
        foreach ($liendd as $k => $liens) {
            if (@$liens['lien'] == 'commandesclients') {
                $commandesclients = $liens['supp'];
            }
        }
        if (($commandesclients <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $this->loadModel('Commandeclients');
        // $this->request->allowMethod(['post', 'delete']);
        $commandeclient = $this->Commandeclients->get($id);
        // $commandecli = $this->Commandeclients->get($id);
        // $commandecli->valider = 0;
        // $this->Commandeclients->save($commandecli);
        $project_id = $commandeclient->projet_id;
        if ($this->Commandeclients->delete($commandeclient)) {

            $this->misejour("Commandeclients", "delete", $id);
            $projet_id = $commandeclient['projet_id'];
            $this->loadModel('Projets');
            $projet = $this->Projets->get($projet_id);
            $datetimeActuelle = FrozenTime::now();
            $datetimeActuelle->format('Y-m-d H:i:s');
            $projet->datemodification = $datetimeActuelle;
            $this->Projets->save($projet);
        } else {
        }
        return $this->redirect(['action' => 'vieww/', $project_id]);
    }
    public function viewcomcli22($id = null)
    {
        //  Configure::write('debug', true);
        $this->loadModel('Commandeclients');
        $this->loadModel('Personnels');
        $commandeclient = $this->Commandeclients->get($id, [
            'contain' => ['Lignecommandeclients', 'Clients', 'Projets', 'Conditionreglements', 'Delailivraisons', 'Methodeexpeditions', 'Devises', 'Incoterms'],
        ]);
        $project_id = $commandeclient->projet_id;

        $this->loadModel('Clients');
        $this->loadModel('Projets');
        $projets = $this->fetchTable('Projets')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $clients = $this->fetchTable('Clients')->find('list', ['keyfield' => 'id', 'valueField' => 'nom']);
        $chauffeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 5 . "%' "]);
        $convoyeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 1 . "%' "]);
        $pointdeventes = $this->Commandeclients->Pointdeventes->find('list', ['limit' => 200]);
        $depots = $this->Commandeclients->Depots->find('list', ['limit' => 200]);
        $cartecarburants = $this->Commandeclients->Cartecarburants->find('list', ['limit' => 200]);
        $materieltransports = $this->Commandeclients->Materieltransports->find('list', ['limit' => 200]);
        $bonlivraisons = $this->Commandeclients->Bonlivraisons->find('list', ['limit' => 200]);
        $this->loadModel('Lignecommandeclients');
        $lignecommandeclientss = $this->Commandeclients->Lignecommandeclients->find('all', [
            'contain' => ['Articles', 'Fournisseurs'],
        ])->where(["Lignecommandeclients.commandeclient_id=" . $id . " "]);
        $connection = ConnectionManager::get('default');
        // $lignecommandeclients = $connection->execute("SELECT lc.* FROM lignecommandeclients lc INNER JOIN (SELECT article_id, MAX(prixht) AS max_price FROM lignecommandeclients WHERE commandeclient_id='".$id."' GROUP BY article_id) AS max_prices ON lc.article_id = max_prices.article_id AND lc.prixht = max_prices.max_price;")->fetchAll('assoc');
        $lignecommandeclients = $connection->execute("SELECT lc.* FROM lignecommandeclients lc INNER JOIN ( SELECT article_id, MAX(prixht) AS max_price FROM lignecommandeclients WHERE lignecommandeclients.type=1 and  commandeclient_id='" . $id . "' GROUP BY article_id) AS max_prices ON lc.article_id = max_prices.article_id AND lc.prixht = max_prices.max_price WHERE lc.commandeclient_id='" . $id . "'")->fetchAll('assoc');
        $lignecommandeclient2s = $connection->execute("SELECT lc.* FROM lignecommandeclients lc INNER JOIN ( SELECT article_id, MAX(prixht) AS max_price FROM lignecommandeclients WHERE lignecommandeclients.type=2 and  commandeclient_id='" . $id . "' GROUP BY article_id) AS max_prices ON lc.article_id = max_prices.article_id AND lc.prixht = max_prices.max_price WHERE lc.commandeclient_id='" . $id . "'")->fetchAll('assoc');
        $lignecommandeclients = $this->Commandeclients->Lignecommandeclients->find('all')->where(["Lignecommandeclients.commandeclient_id=" . $id, "Lignecommandeclients.type=1 "]);
        $lignecommandeclient2s = $this->Commandeclients->Lignecommandeclients->find('all')->where(["Lignecommandeclients.commandeclient_id=" . $id, "Lignecommandeclients.type=2"]);
        // debug($lignecommandeclients)
        // debug($lignecommandeclients);
        $this->loadModel('Articles');
        $articles = $this->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Articles.vente = 1"]);

        $devises = $this->fetchTable('Devises')->find('list', [
            'keyfield' => 'id',
            'valueField' => function ($d) {
                return $d->name . ' (' . $d->symbole . ')';
            }
        ]);
        $incoterms = $this->fetchTable('Incoterms')->find('list', ['keyfield' => 'id', 'valueField' => 'code']);
        $incotermpdfs = $this->fetchTable('Incoterms')->find('list', ['keyfield' => 'id', 'valueField' => 'code']);
        if ($commandeclient['banque_id']) {
            $comptesBanks = $this->fetchtable('ComptesBank')->find('all')->where(['ComptesBank.banque_id' => $commandeclient['banque_id']]);
            //debug($comptesBanks->toArray());
        }
        if ($commandeclient['incotermpdf_id']) {
            $Incoterm = $this->fetchtable('Incoterms')->find('all')->where(['Incoterms.id' => $commandeclient['incotermpdf_id']])->first();
            //debug($comptesBanks->toArray());
        }
        $banques = $this->fetchTable('Banques')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $parametretaus = $this->fetchTable('Parametretaus')->find('all')->first();
        if ($commandeclient['devis_id']) {
            $devise = $connection->execute("SELECT code FROM devises WHERE id='" . $commandeclient['devis_id'] . "'")->fetch('assoc');
            //debug($devise);//die;
            $code = $devise['code'];
            $deviseprojet2 = $devise['code'];
        }
        //  debug($deviseprojet2);//die;
        if ($commandeclient['devisachat_id']) {

            $pro = $connection->execute("SELECT code FROM devises WHERE id=" . $commandeclient['devisachat_id'] . " ")->fetch('assoc');
            //  debug($pro);//die;
            $deviseprojet = $pro['code'];
        } //debug($commandeclient);//die;
        $typeremises['1'] = "Pourcentage";
        $typeremises['2'] = "Valeur";
        if ($commandeclient['comptesBank_id']) {
            $comptesBank = $this->fetchtable('ComptesBank')->find('all')->where(['ComptesBank.id' => $commandeclient['comptesBank_id']])->first();
            //debug($comptesBanks->toArray());
        }
        debug($commandeclient);
        debug($lignecommandeclientss->toArray());
        // $this->downloadPdfimp12($id);
        $tracemisejours = $this->fetchTable('Tracemisejours')->find('all', ['contain' => ['Users']])->where(['(Tracemisejours.model="Commande client" OR Tracemisejours.model="Offre ggb")', 'Tracemisejours.id_piece=' . $id]);

        $this->set(compact('comptesBanks', 'deviseprojet2', 'lignecommandeclientss', 'tracemisejours', 'Incoterm', 'comptesBank', 'typeremises', 'deviseprojet', 'parametretaus', 'banques', 'lignecommandeclient2s', 'incotermpdfs', 'project_id', 'devises', 'incoterms', 'lignecommandeclients', 'articles', 'commandeclient', 'clients', 'projets', 'depots', 'cartecarburants', 'materieltransports', 'chauffeurs', 'convoyeurs', 'bonlivraisons'));
    }
    public function viewcomcli($id = null)
    {
        $this->loadModel('Commandeclients');
        $this->loadModel('Personnels');
        $commandeclient = $this->Commandeclients->get($id, [
            'contain' => ['Lignecommandeclients'],
        ]);
        $project_id = $commandeclient->projet_id;

        $this->loadModel('Clients');
        $this->loadModel('Projets');
        $projets = $this->fetchTable('Projets')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $clients = $this->fetchTable('Clients')->find('list', ['keyfield' => 'id', 'valueField' => 'nom']);
        $chauffeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 5 . "%' "]);
        $convoyeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 1 . "%' "]);
        $pointdeventes = $this->Commandeclients->Pointdeventes->find('list', ['limit' => 200]);
        $depots = $this->Commandeclients->Depots->find('list', ['limit' => 200]);
        $cartecarburants = $this->Commandeclients->Cartecarburants->find('list', ['limit' => 200]);
        $materieltransports = $this->Commandeclients->Materieltransports->find('list', ['limit' => 200]);
        $bonlivraisons = $this->Commandeclients->Bonlivraisons->find('list', ['limit' => 200]);
        $this->loadModel('Lignecommandeclients');
        // $lignecommandeclients = $this->Commandeclients->Lignecommandeclients->find('all')->where(["Lignecommandeclients.commandeclient_id=" . $id . " "]);
        $connection = ConnectionManager::get('default');
        // $lignecommandeclients = $connection->execute("SELECT lc.* FROM lignecommandeclients lc INNER JOIN (SELECT article_id, MAX(prixht) AS max_price FROM lignecommandeclients WHERE commandeclient_id='".$id."' GROUP BY article_id) AS max_prices ON lc.article_id = max_prices.article_id AND lc.prixht = max_prices.max_price;")->fetchAll('assoc');
        $lignecommandeclients = $connection->execute("SELECT lc.* FROM lignecommandeclients lc INNER JOIN ( SELECT article_id, MAX(prixht) AS max_price FROM lignecommandeclients WHERE lignecommandeclients.type=1 and  commandeclient_id='" . $id . "' GROUP BY article_id) AS max_prices ON lc.article_id = max_prices.article_id AND lc.prixht = max_prices.max_price WHERE lc.commandeclient_id='" . $id . "'")->fetchAll('assoc');
        $lignecommandeclient2s = $connection->execute("SELECT lc.* FROM lignecommandeclients lc INNER JOIN ( SELECT article_id, MAX(prixht) AS max_price FROM lignecommandeclients WHERE lignecommandeclients.type=2 and  commandeclient_id='" . $id . "' GROUP BY article_id) AS max_prices ON lc.article_id = max_prices.article_id AND lc.prixht = max_prices.max_price WHERE lc.commandeclient_id='" . $id . "'")->fetchAll('assoc');
        $lignecommandeclients = $this->Commandeclients->Lignecommandeclients->find('all')->where(["Lignecommandeclients.commandeclient_id=" . $id, "Lignecommandeclients.type=1 "]);
        $lignecommandeclient2s = $this->Commandeclients->Lignecommandeclients->find('all')->where(["Lignecommandeclients.commandeclient_id=" . $id, "Lignecommandeclients.type=2"]);
        // debug($lignecommandeclients)
        // debug($lignecommandeclients);
        $this->loadModel('Articles');
        $articles = $this->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Articles.vente = 1"]);

        $devises = $this->fetchTable('Devises')->find('list', [
            'keyfield' => 'id',
            'valueField' => function ($d) {
                return $d->name . ' (' . $d->symbole . ')';
            }
        ]);
        $incoterms = $this->fetchTable('Incoterms')->find('list', ['keyfield' => 'id', 'valueField' => 'code']);
        $incotermpdfs = $this->fetchTable('Incoterms')->find('list', ['keyfield' => 'id', 'valueField' => 'code']);
        if ($commandeclient['banque_id']) {
            $comptesBanks = $this->fetchtable('ComptesBank')->find('all')->where(['ComptesBank.banque_id' => $commandeclient['banque_id']]);
            //debug($comptesBanks->toArray());
        }
        if ($commandeclient['comptesBank_id']) {
            $comptesBanks = $this->fetchtable('ComptesBank')->find('all')->where(['ComptesBank.banque_id' => $commandeclient['banque_id']]);
            //debug($comptesBanks->toArray());
        }
        $banques = $this->fetchTable('Banques')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $parametretaus = $this->fetchTable('Parametretaus')->find('all')->first();
        if ($commandeclient['devis_id']) {
            $devise = $connection->execute("SELECT code FROM devises WHERE id='" . $commandeclient['devis_id'] . "'")->fetch('assoc');
            //debug($devise);//die;
            $code = $devise['code'];
            $deviseprojet2 = $devise['code'];
        }
        //  debug($deviseprojet2);//die;
        if ($commandeclient['devisachat_id']) {

            $pro = $connection->execute("SELECT code FROM devises WHERE id=" . $commandeclient['devisachat_id'] . " ")->fetch('assoc');
            //  debug($pro);//die;
            $deviseprojet = $pro['code'];
        } //debug($commandeclient);//die;
        $typeremises['1'] = "Pourcentage";
        $typeremises['2'] = "Valeur";
        $this->set(compact('comptesBanks', 'deviseprojet2', 'typeremises', 'deviseprojet', 'parametretaus', 'banques', 'lignecommandeclient2s', 'incotermpdfs', 'project_id', 'devises', 'incoterms', 'lignecommandeclients', 'articles', 'commandeclient', 'clients', 'projets', 'depots', 'cartecarburants', 'materieltransports', 'chauffeurs', 'convoyeurs', 'bonlivraisons'));
    }
    public function editcomcli($id = null)
    {

        $connection = ConnectionManager::get('default');
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_vente' . $abrv);
        $commandesclients = 0;
        foreach ($liendd as $k => $liens) {
            if (@$liens['lien'] == 'commandesclients') {
                $commandesclients = $liens['modif'];
            }
        }
        if (($commandesclients <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $this->loadModel('Commandeclients');
        $this->loadModel('Personnels');

        $commandeclient = $this->Commandeclients->get($id, [
            'contain' => ['Lignecommandeclients'],
        ]);

        $project_id = $commandeclient->projet_id;
        if ($this->request->is(['patch', 'post', 'put'])) {
            //debug($this->request->getData('data')['lignecommandeclients']);die;



            $data['incoterm_id'] = $this->request->getData('incoterm_id');
            $data['typeremise_id'] = $this->request->getData('typeremise_id');
            $data['incotermpdf_id'] = $this->request->getData('incotermpdf_id');
            $data['devis_id'] = $this->request->getData('devise_id');
            $data['devisachat_id'] = $this->request->getData('devisachat_id');
            $data['typearticle'] = $this->request->getData('typearticle');
            $data['devis2_id'] = $this->request->getData('devis2_id');
            $data['tauxdechange'] = $this->request->getData('tauxdechange');
            $data['tauxdechange2'] = $this->request->getData('tauxdechange2');
            $data['pay'] = $this->request->getData('pay');
            $data['modetransport_id'] = $this->request->getData('modetransport_id');
            $data['detailtransport'] = $this->request->getData('detailtransport');
            $data['nbfergule'] = $this->request->getData('nbfergule');
            $data['remisetotal'] = $this->request->getData('remisetotal');
            $data['datelivraison'] = $this->request->getData('datelivraison');
            $data['methodeexpedition_id'] = $this->request->getData('methodeexpedition_id');
            $data['delailivraison_id'] = $this->request->getData('delailivraison_id');
            $data['conditionreglement_id'] = $this->request->getData('conditionreglement_id');
            $data['totalmarge'] = $this->request->getData('data')['totalmarge'];
            $data['totalht'] = $this->request->getData('data')['totalht'];
            $data['totaltva'] = $this->request->getData('data')['totaltva'];
            $data['totalremise'] = $this->request->getData('data')['totalremise'];
            $data['remisetotalval'] = $this->request->getData('data')['remisetotalval'];
            $data['totalttc'] = $this->request->getData('data')['totalttc'];
            $data['totalttcdl'] = $this->request->getData('data')['totalttcdl'];
            $data['totalfodec'] = $this->request->getData('data')['totalfodec'];
            $data['comptesBank_id'] = $this->request->getData('data')['comptesBank_id'];
            $data['banque_id'] = $this->request->getData('data')['banque_id'];
            $commandeclient = $this->Commandeclients->patchEntity($commandeclient, $this->request->getData(), ['associated' => ['Lignecommandeclients' => ['validate' => false]]]);

            $this->Commandeclients->save($commandeclient, $data);
            // debug($commandeclient);die;
            if ($this->Commandeclients->save($commandeclient)) {
                //debug($commandeclient);die;
                //$paiement_idcom='';
                $Clientpaiement = $this->fetchTable('Clientpaiements')->find('all')->where('Clientpaiements.commandeclient_id =' . $id);
                foreach ($Clientpaiement as $itemm) {
                    $this->loadModel('Clientpaiements');
                    $this->Clientpaiements->delete($itemm);
                }

                foreach ($this->request->getData('paiement_id') as $key => $paicom) {
                    $clientpaiement = $this->fetchTable('Clientpaiements')->newEmptyEntity();
                    $dattc['paiement_id'] = $paicom;
                    $dattc['commandeclient_id'] = $commandeclient->id;
                    $clientpaiement = $this->fetchTable('Clientpaiements')->patchEntity($clientpaiement, $dattc);
                    $this->fetchTable('Clientpaiements')->save($clientpaiement);
                }
                $this->misejour("Offre ggb", "edit", $id);
                $this->misejour("Offre ggb", "editprojet", $project_id);
                $projet_id = $commandeclient['projet_id'];
                $this->loadModel('Projets');
                $projet = $this->Projets->get($projet_id);
                $datetimeActuelle = FrozenTime::now();
                $datetimeActuelle->format('Y-m-d H:i:s');
                $projet->datemodification = $datetimeActuelle;
                $this->Projets->save($projet);
                $lignecommandeclient = $this->fetchTable('lignecommandeclients')->find('all')->where('lignecommandeclients.commandeclient_id =' . $id);
                foreach ($lignecommandeclient as $item) {
                    $this->loadModel('Lignecommandeclients');
                    $this->Lignecommandeclients->delete($item);
                }
                if (isset($this->request->getData('data')['lignecommandeclients']) && (!empty($this->request->getData('data')['lignecommandeclients']))) {
                    foreach ($this->request->getData('data')['lignecommandeclients'] as $i => $res) {
                        // debug($this->request->getData('data')['lignecommandeclients']);
                        if ($res['sup0'] != 1) {
                            $dat['fournisseur_id'] = $res['fournisseur_id'];
                            $dat['type'] = $res['type'];
                            $dat['article_id'] = $res['article_id'];
                            $dat['unite_id'] = $res['unite_id'];
                            //$dat['unite_id'] = $res['unite_idd'];
                            $dat['qte'] = $res['qte'];
                            $dat['tauxdemarge'] = $res['tauxdemarge'];
                            $dat['tauxdemarque'] = $res['tauxdemarque'];
                            $dat['description'] = $res['description'];
                            $dat['coutrevient'] = $res['coutrevient'];
                            $dat['prixht'] = $res['prixht'];

                            $dat['punht'] = $res['punht'];
                            $dat['tva'] = $res['tva'];
                            $dat['fodec'] = $res['fodec'];
                            $dat['nbvirgule'] = $res['nbvirgule'];
                            $dat['ttc'] = $res['ttc'];
                            $dat['commandeclient_id'] = $id;
                            $dat['typeremise_id'] = (int) $res['typeremise_id'];
                            if ($res['typeremise_id'] == 1) {
                                $dat['remise'] = $res['remise'];
                                $dat['remiseval'] = 0;
                            } else if ($res['typeremise_id'] == 2) {
                                $dat['remiseval'] = $res['remiseval'];
                                $dat['remise'] = 0;
                            }

                            $lignecommandeclient = $this->fetchTable('lignecommandeclients')->newEmptyEntity();
                            // }
                            $lignecommandeclient = $this->fetchTable('lignecommandeclients')->patchEntity($lignecommandeclient, $dat);
                            // debug($lignecommandeclient);

                            if ($this->fetchTable('lignecommandeclients')->save($lignecommandeclient)) {
                                // debug($lignecommandeclient->typeremise_id);
                            }
                        }

                        $this->set(compact("lignecommandeclient"));
                    }
                }

?>
                <!-- <script>
                    var currentUrl = window.location.href;
                    var parentUrl = currentUrl.split('/').slice(0, -2).join('/');
                    var link = parentUrl + "/impfichier/<?php echo $id ?>/<?php echo $commandeclient->projet_id; ?>";



                    openWindow(1000, 1000, link);



                    function openWindow(h, w, url) {
                        leftOffset = (screen.width / 2) - w / 2;
                        topOffset = (screen.height / 2) - h / 2;
                        var popup = window.open(url, 'PopupWindow', 'left=' + leftOffset + ',top=' + topOffset + ',width=' + w + ',height=' + h + ',resizable,scrollbars=yes');

                        var checkPopupClosed = setInterval(function () {
                            if (popup.closed) {
                                clearInterval(checkPopupClosed);
                                window.location.href = parentUrl + '/editcomcli/<?php echo $id ?>';
                            }
                        }, 1000);

                    }
                </script> -->
            <?php
            }
            //return $this->redirect(['action' => 'vieww/', $project_id]);
            // return $this->redirect(['action' => 'editcomcli/', $id]);
        }
        $this->loadModel('Clients');
        $this->loadModel('Projets');
        $Projet = $this->Projets->get($project_id);
        if ($commandeclient['devisachat_id']) {

            $pro = $connection->execute("SELECT code FROM devises WHERE id=" . $commandeclient['devisachat_id'] . " ")->fetch('assoc');
            //debug($pro);//die;
            $deviseprojet = $pro[0]['code'];
        }

        $projets = $this->fetchTable('Projets')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $clients = $this->fetchTable('Clients')->find('list', ['keyfield' => 'id', 'valueField' => 'nom']);
        $chauffeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 5 . "%' "]);
        $convoyeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 1 . "%' "]);
        $pointdeventes = $this->Commandeclients->Pointdeventes->find('list', ['limit' => 200]);
        $depots = $this->Commandeclients->Depots->find('list', ['limit' => 200]);
        $cartecarburants = $this->Commandeclients->Cartecarburants->find('list', ['limit' => 200]);
        $materieltransports = $this->Commandeclients->Materieltransports->find('list', ['limit' => 200]);
        $bonlivraisons = $this->Commandeclients->Bonlivraisons->find('list', ['limit' => 200]);
        $this->loadModel('Lignecommandeclients');
        // $lignecommandeclients = $this->Commandeclients->Lignecommandeclients->find('all')->where(["Lignecommandeclients.commandeclient_id=" . $id . " "])->ToArray();
        // debug($id);
        $connection = ConnectionManager::get('default');
        $lignecommandeclients = $this->Commandeclients->Lignecommandeclients->find('all')->where(["Lignecommandeclients.commandeclient_id=" . $id, "Lignecommandeclients.type=1"]); //->ToArray();
        // $lignecommandeclients = $connection->execute("SELECT lc.* FROM lignecommandeclients lc INNER JOIN ( SELECT article_id, MAX(prixht) AS max_price FROM lignecommandeclients WHERE lignecommandeclients.type=1 and commandeclient_id='" . $id . "' GROUP BY article_id) AS max_prices ON lc.article_id = max_prices.article_id AND lc.prixht = max_prices.max_price WHERE lc.commandeclient_id='" . $id . "'")->fetchAll('assoc');
        // $lignecommandeclient2s = $connection->execute("SELECT lc.* FROM lignecommandeclients lc INNER JOIN ( SELECT article_id, MAX(prixht) AS max_price FROM lignecommandeclients WHERE lignecommandeclients.type=2 and  commandeclient_id='" . $id . "' GROUP BY article_id) AS max_prices ON lc.article_id = max_prices.article_id AND lc.prixht = max_prices.max_price WHERE lc.commandeclient_id='" . $id . "'")->fetchAll('assoc');
        $lignecommandeclient2s = $this->Commandeclients->Lignecommandeclients->find('all')->where(["Lignecommandeclients.commandeclient_id=" . $id, "Lignecommandeclients.type=2"]); //->ToArray();
        // debug($lignecommandeclients);die;

        $indexcc = count($lignecommandeclients->toArray());
        //echo $indexcc;

        $this->loadModel('Articles');


        // $devises = $this->fetchTable('Devises')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $devises = $this->fetchTable('Devises')->find('list', [
            'keyfield' => 'id',
            'valueField' => function ($d) {
                return $d->name . ' (' . $d->symbole . ')';
            }
        ]);
        $incoterms = $this->fetchTable('Incoterms')->find('list', ['keyfield' => 'id', 'valueField' => 'code']);
        $connection = ConnectionManager::get('default');
        $code = '-1';

        if ($commandeclient['devis_id']) {
            $devise = $connection->execute("SELECT code FROM devises WHERE id='" . $commandeclient['devis_id'] . "'")->fetch('assoc');
            // debug($devise);die;
            $code = $devise['code'];
            $deviseprojet2 = $devise[0]['code'];
        }
        if ($commandeclient['banque_id']) {
            $comptesBanks = $this->fetchtable('ComptesBank')->find('all')->where(['ComptesBank.banque_id' => $commandeclient['banque_id']]);
            //debug($comptesBanks->toArray());
        }
        $incotermpdfs = $this->fetchTable('Incoterms')->find('list', ['keyfield' => 'id', 'valueField' => 'code']);
        $this->loadModel('Paiements');
        $paiements = $this->Paiements->find('list', ['keyfield' => 'id', 'valueField' => 'name']);


        if ($commandeclient['paiement_id']) {
            $gg = explode(" ", $commandeclient['paiement_id']);
        }

        $Clientpaiement = $this->fetchTable('Clientpaiements')->find('all')->where('Clientpaiements.commandeclient_id =' . $id);
        $gg = [];
        foreach ($Clientpaiement as $itemm) {

            array_push($gg, $itemm['paiement_id']);
        }
        $pays = $this->fetchTable('Pays')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        //debug($gg) ;
        $modetransports = $this->fetchTable('Modetransports')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        // debug($lignecommandeclients);die;
        $unites = $this->fetchTable('Unites')->find('all'); //, ['keyfield' => 'id', 'valueField' => 'name']);
        //debug($articles->toArray());
        $this->loadModel('Fournisseurs');
        $articles = $this->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Articles.typearticle = 1"]);
        $articleservises = $this->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Articles.typearticle = 2"]);
        $conditionreglements = $this->fetchTable('Conditionreglements')->find('list', ['keyfield' => 'id', 'valueField' => 'conditionn']);
        $delailivraisons = $this->fetchTable('Delailivraisons')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $methodeexpeditions = $this->fetchTable('Methodeexpeditions')->find('list', ['keyfield' => 'id', 'valueField' => 'methode']);
        $fournisseurs = $this->Fournisseurs->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $banques = $this->fetchTable('Banques')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $parametretaus = $this->fetchTable('Parametretaus')->find('all')->first();
        $typeremises['1'] = "%";
        $typeremises['2'] = "Valeur";
        $this->set(compact('typeremises', 'comptesBanks', 'parametretaus', 'deviseprojet2', 'banques', 'fournisseurs', 'deviseprojet', 'methodeexpeditions', 'delailivraisons', 'conditionreglements', 'articleservises', 'lignecommandeclient2s', 'unites', 'project_id', 'gg', 'modetransports', 'pays', 'paiements', 'incotermpdfs', 'devises', 'incoterms', 'code', 'lignecommandeclients', 'articles', 'commandeclient', 'clients', 'projets', 'depots', 'cartecarburants', 'materieltransports', 'chauffeurs', 'convoyeurs', 'bonlivraisons'));
    }
    public function editcomcli02102024($id = null)
    {

        $connection = ConnectionManager::get('default');
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_vente' . $abrv);
        $commandesclients = 0;
        foreach ($liendd as $k => $liens) {
            if (@$liens['lien'] == 'commandesclients') {
                $commandesclients = $liens['modif'];
            }
        }
        if (($commandesclients <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $this->loadModel('Commandeclients');
        $this->loadModel('Personnels');

        $commandeclient = $this->Commandeclients->get($id, [
            'contain' => ['Lignecommandeclients'],
        ]);
        //debug($commandeclient);
        $project_id = $commandeclient->projet_id;
        if ($this->request->is(['patch', 'post', 'put'])) {
            //debug($this->request->getData('data')['lignecommandeclients']);die;



            $data['incoterm_id'] = $this->request->getData('incoterm_id');
            $data['incotermpdf_id'] = $this->request->getData('incotermpdf_id');
            $data['devis_id'] = $this->request->getData('devise_id');
            $data['devisachat_id'] = $this->request->getData('devisachat_id');
            $data['typearticle'] = $this->request->getData('typearticle');
            $data['devis2_id'] = $this->request->getData('devis2_id');
            $data['tauxdechange'] = $this->request->getData('tauxdechange');
            $data['tauxdechange2'] = $this->request->getData('tauxdechange2');
            $data['pay'] = $this->request->getData('pay');
            $data['modetransport_id'] = $this->request->getData('modetransport_id');
            $data['detailtransport'] = $this->request->getData('detailtransport');
            $data['nbfergule'] = $this->request->getData('nbfergule');
            $data['remisetotal'] = $this->request->getData('remisetotal');
            $data['datelivraison'] = $this->request->getData('datelivraison');
            $data['methodeexpedition_id'] = $this->request->getData('methodeexpedition_id');
            $data['delailivraison_id'] = $this->request->getData('delailivraison_id');
            $data['conditionreglement_id'] = $this->request->getData('conditionreglement_id');
            $data['totalmarge'] = $this->request->getData('data')['totalmarge'];
            $data['totalht'] = $this->request->getData('data')['totalht'];
            $data['totaltva'] = $this->request->getData('data')['totaltva'];
            $data['totalremise'] = $this->request->getData('data')['totalremise'];
            $data['remisetotalval'] = $this->request->getData('data')['remisetotalval'];
            $data['totalttc'] = $this->request->getData('data')['totalttc'];
            $data['totalttcdl'] = $this->request->getData('data')['totalttcdl'];
            $data['totalfodec'] = $this->request->getData('data')['totalfodec'];
            $data['comptesBank_id'] = $this->request->getData('data')['comptesBank_id'];
            $data['banque_id'] = $this->request->getData('data')['banque_id'];
            $commandeclient = $this->Commandeclients->patchEntity($commandeclient, $this->request->getData(), ['associated' => ['Lignecommandeclients' => ['validate' => false]]]);

            $this->Commandeclients->save($commandeclient, $data);
            // debug($commandeclient);die;
            if ($this->Commandeclients->save($commandeclient)) {
                //debug($commandeclient);die;
                //$paiement_idcom='';
                $Clientpaiement = $this->fetchTable('Clientpaiements')->find('all')->where('Clientpaiements.commandeclient_id =' . $id);
                foreach ($Clientpaiement as $itemm) {
                    $this->loadModel('Clientpaiements');
                    $this->Clientpaiements->delete($itemm);
                }

                foreach ($this->request->getData('paiement_id') as $key => $paicom) {
                    $clientpaiement = $this->fetchTable('Clientpaiements')->newEmptyEntity();
                    $dattc['paiement_id'] = $paicom;
                    $dattc['commandeclient_id'] = $commandeclient->id;
                    $clientpaiement = $this->fetchTable('Clientpaiements')->patchEntity($clientpaiement, $dattc);
                    $this->fetchTable('Clientpaiements')->save($clientpaiement);
                }
                $this->misejour("Offre ggb", "edit", $id);
                $this->misejour("Offre ggb", "edit", $project_id);
                $projet_id = $commandeclient['projet_id'];
                $this->loadModel('Projets');
                $projet = $this->Projets->get($projet_id);
                $datetimeActuelle = FrozenTime::now();
                $datetimeActuelle->format('Y-m-d H:i:s');
                $projet->datemodification = $datetimeActuelle;
                $this->Projets->save($projet);
                $lignecommandeclient = $this->fetchTable('lignecommandeclients')->find('all')->where('lignecommandeclients.commandeclient_id =' . $id);
                foreach ($lignecommandeclient as $item) {
                    $this->loadModel('Lignecommandeclients');
                    $this->Lignecommandeclients->delete($item);
                }
                if (isset($this->request->getData('data')['lignecommandeclients']) && (!empty($this->request->getData('data')['lignecommandeclients']))) {
                    foreach ($this->request->getData('data')['lignecommandeclients'] as $i => $res) {
                        // debug($this->request->getData('data')['lignecommandeclients']);
                        if ($res['sup0'] != 1) {
                            $dat['fournisseur_id'] = $res['fournisseur_id'];
                            $dat['type'] = $res['type'];
                            $dat['article_id'] = $res['article_id'];
                            $dat['unite_id'] = $res['unite_id'];
                            //$dat['unite_id'] = $res['unite_idd'];
                            $dat['qte'] = $res['qte'];
                            $dat['tauxdemarge'] = $res['tauxdemarge'];
                            $dat['tauxdemarque'] = $res['tauxdemarque'];
                            $dat['description'] = $res['description'];
                            $dat['coutrevient'] = $res['coutrevient'];
                            $dat['prixht'] = $res['prixht'];
                            $dat['remise'] = $res['remise'];
                            $dat['punht'] = $res['punht'];
                            $dat['tva'] = $res['tva'];
                            $dat['fodec'] = $res['fodec'];
                            $dat['nbvirgule'] = $res['nbvirgule'];
                            $dat['ttc'] = $res['ttc'];
                            $dat['commandeclient_id'] = $id;

                            $lignecommandeclient = $this->fetchTable('lignecommandeclients')->newEmptyEntity();
                            // }
                            $lignecommandeclient = $this->fetchTable('lignecommandeclients')->patchEntity($lignecommandeclient, $dat);
                            // debug($lignecommandeclient);

                            if ($this->fetchTable('lignecommandeclients')->save($lignecommandeclient)) {
                                // debug($lignecommandeclient);
                            }
                        }
                        $this->set(compact("lignecommandeclient"));
                    }
                }

            ?>
                <script>
                    var currentUrl = window.location.href;
                    var parentUrl = currentUrl.split('/').slice(0, -2).join('/');
                    var link = parentUrl + "/impfichier/<?php echo $id ?>/<?php echo $commandeclient->projet_id; ?>";



                    openWindow(1000, 1000, link);



                    function openWindow(h, w, url) {
                        leftOffset = (screen.width / 2) - w / 2;
                        topOffset = (screen.height / 2) - h / 2;
                        var popup = window.open(url, 'PopupWindow', 'left=' + leftOffset + ',top=' + topOffset + ',width=' + w + ',height=' + h + ',resizable,scrollbars=yes');

                        var checkPopupClosed = setInterval(function() {
                            if (popup.closed) {
                                clearInterval(checkPopupClosed);
                                // Réaliser une action après la fermeture du popup (comme recharger la page si nécessaire)
                                window.location.href = parentUrl + '/editcomcli/<?php echo $id ?>';
                            }
                        }, 1000);

                    }
                </script>
                <?php
            }
            //return $this->redirect(['action' => 'vieww/', $project_id]);
            // return $this->redirect(['action' => 'editcomcli/', $id]);
        }
        $this->loadModel('Clients');
        $this->loadModel('Projets');
        $Projet = $this->Projets->get($project_id);
        if ($commandeclient['devisachat_id']) {

            $pro = $connection->execute("SELECT code FROM devises WHERE id=" . $commandeclient['devisachat_id'] . " ")->fetch('assoc');
            //debug($pro);//die;
            $deviseprojet = $pro[0]['code'];
        }

        $projets = $this->fetchTable('Projets')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $clients = $this->fetchTable('Clients')->find('list', ['keyfield' => 'id', 'valueField' => 'nom']);
        $chauffeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 5 . "%' "]);
        $convoyeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 1 . "%' "]);
        $pointdeventes = $this->Commandeclients->Pointdeventes->find('list', ['limit' => 200]);
        $depots = $this->Commandeclients->Depots->find('list', ['limit' => 200]);
        $cartecarburants = $this->Commandeclients->Cartecarburants->find('list', ['limit' => 200]);
        $materieltransports = $this->Commandeclients->Materieltransports->find('list', ['limit' => 200]);
        $bonlivraisons = $this->Commandeclients->Bonlivraisons->find('list', ['limit' => 200]);
        $this->loadModel('Lignecommandeclients');
        // $lignecommandeclients = $this->Commandeclients->Lignecommandeclients->find('all')->where(["Lignecommandeclients.commandeclient_id=" . $id . " "])->ToArray();
        // debug($id);
        $connection = ConnectionManager::get('default');
        $lignecommandeclients = $this->Commandeclients->Lignecommandeclients->find('all')->where(["Lignecommandeclients.commandeclient_id=" . $id, "Lignecommandeclients.type=1"]); //->ToArray();
        // $lignecommandeclients = $connection->execute("SELECT lc.* FROM lignecommandeclients lc INNER JOIN ( SELECT article_id, MAX(prixht) AS max_price FROM lignecommandeclients WHERE lignecommandeclients.type=1 and commandeclient_id='" . $id . "' GROUP BY article_id) AS max_prices ON lc.article_id = max_prices.article_id AND lc.prixht = max_prices.max_price WHERE lc.commandeclient_id='" . $id . "'")->fetchAll('assoc');
        // $lignecommandeclient2s = $connection->execute("SELECT lc.* FROM lignecommandeclients lc INNER JOIN ( SELECT article_id, MAX(prixht) AS max_price FROM lignecommandeclients WHERE lignecommandeclients.type=2 and  commandeclient_id='" . $id . "' GROUP BY article_id) AS max_prices ON lc.article_id = max_prices.article_id AND lc.prixht = max_prices.max_price WHERE lc.commandeclient_id='" . $id . "'")->fetchAll('assoc');
        $lignecommandeclient2s = $this->Commandeclients->Lignecommandeclients->find('all')->where(["Lignecommandeclients.commandeclient_id=" . $id, "Lignecommandeclients.type=2"]); //->ToArray();
        // debug($lignecommandeclients);die;

        $this->loadModel('Articles');


        // $devises = $this->fetchTable('Devises')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $devises = $this->fetchTable('Devises')->find('list', [
            'keyfield' => 'id',
            'valueField' => function ($d) {
                return $d->name . ' (' . $d->symbole . ')';
            }
        ]);
        $incoterms = $this->fetchTable('Incoterms')->find('list', ['keyfield' => 'id', 'valueField' => 'code']);
        $connection = ConnectionManager::get('default');
        $code = '-1';

        if ($commandeclient['devis_id']) {
            $devise = $connection->execute("SELECT code FROM devises WHERE id='" . $commandeclient['devis_id'] . "'")->fetch('assoc');
            // debug($devise);die;
            $code = $devise['code'];
            $deviseprojet2 = $devise[0]['code'];
        }
        if ($commandeclient['banque_id']) {
            $comptesBanks = $this->fetchtable('ComptesBank')->find('all')->where(['ComptesBank.banque_id' => $commandeclient['banque_id']]);
            //debug($comptesBanks->toArray());
        }
        $incotermpdfs = $this->fetchTable('Incoterms')->find('list', ['keyfield' => 'id', 'valueField' => 'code']);
        $this->loadModel('Paiements');
        $paiements = $this->Paiements->find('list', ['keyfield' => 'id', 'valueField' => 'name']);


        if ($commandeclient['paiement_id']) {
            $gg = explode(" ", $commandeclient['paiement_id']);
        }

        $Clientpaiement = $this->fetchTable('Clientpaiements')->find('all')->where('Clientpaiements.commandeclient_id =' . $id);
        $gg = [];
        foreach ($Clientpaiement as $itemm) {

            array_push($gg, $itemm['paiement_id']);
        }
        $pays = $this->fetchTable('Pays')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        //debug($gg) ;
        $modetransports = $this->fetchTable('Modetransports')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        // debug($lignecommandeclients);die;
        $unites = $this->fetchTable('Unites')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        //debug($articles->toArray());
        $this->loadModel('Fournisseurs');
        $articles = $this->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Articles.typearticle = 1"]);
        $articleservises = $this->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Articles.typearticle = 2"]);
        $conditionreglements = $this->fetchTable('Conditionreglements')->find('list', ['keyfield' => 'id', 'valueField' => 'conditionn']);
        $delailivraisons = $this->fetchTable('Delailivraisons')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $methodeexpeditions = $this->fetchTable('Methodeexpeditions')->find('list', ['keyfield' => 'id', 'valueField' => 'methode']);
        $fournisseurs = $this->Fournisseurs->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $banques = $this->fetchTable('Banques')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $parametretaus = $this->fetchTable('Parametretaus')->find('all')->first();
        $this->set(compact('comptesBanks', 'parametretaus', 'deviseprojet2', 'banques', 'fournisseurs', 'deviseprojet', 'methodeexpeditions', 'delailivraisons', 'conditionreglements', 'articleservises', 'lignecommandeclient2s', 'unites', 'project_id', 'gg', 'modetransports', 'pays', 'paiements', 'incotermpdfs', 'devises', 'incoterms', 'code', 'lignecommandeclients', 'articles', 'commandeclient', 'clients', 'projets', 'depots', 'cartecarburants', 'materieltransports', 'chauffeurs', 'convoyeurs', 'bonlivraisons'));
    }
    public function addcmdcli($project_id = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_vente' . $abrv);
        $commandesclients = 0;
        foreach ($liendd as $k => $liens) {
            if (@$liens['lien'] == 'commandesclients') {
                $commandesclients = $liens['modif'];
            }
        }
        if (($commandesclients <> 1)) {
            // $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $this->loadModel('Commandeclients');
        $this->loadModel('Lignecommandeclients');
        $this->loadModel('Personnels');
        $numeroobj = $this->Commandeclients->find()->select([
            "numerox" =>
            'MAX(Commandeclients.code)'
        ])->first();
        $numero = $numeroobj->numerox;
        if ($numero != null) {
            $n = $numero;
            $lastnum = $n;
            $nume = intval($lastnum) + 1;
            $nn = (string) $nume;
            $code = str_pad($nn, 6, "0", STR_PAD_LEFT);
        } else {
            $code = "000001";
        }
        $this->set(compact('code'));
        $commandeclient = $this->Commandeclients->newEmptyEntity();
        if ($this->request->is(['patch', 'post', 'put'])) {
            // debug($this->request->getData());die;
            $datacomm['code'] = $this->request->getData('code');
            $datacomm['tvaOnOff'] = $this->request->getData('tvaOnOff');
            $datacomm['client_id'] = $this->request->getData('client_id');
            $datacomm['depot_id'] = $this->request->getData('depot_id');
            $datacomm['datedecreation'] = $this->request->getData('date');
            $datacomm['date'] = $this->request->getData('date');
            $datacomm['commentaire'] = $this->request->getData('commentaire');

            $datacomm['duree_validite'] = $this->request->getData('duree_validite');
            $datacomm['incoterm_id'] = $this->request->getData('incoterm_id');
            $datacomm['incotermpdf_id'] = $this->request->getData('incotermpdf_id');
            $datacomm['typearticle'] = $this->request->getData('typearticle');
            $datacomm['total_transport'] = $this->request->getData('total_transport');

            $datacomm['tauxdechange2'] = $this->request->getData('tauxdechange2');
            $datacomm['devis_id'] = $this->request->getData('devis_id');
            $datacomm['devisachat_id'] = $this->request->getData('devisachat_id');
            $datacomm['tauxdechange'] = $this->request->getData('tauxdechange');
            $datacomm['devis2_id'] = $this->request->getData('devis2_id');
            $datacomm['pay'] = $this->request->getData('pay');
            $datacomm['modetransport_id'] = $this->request->getData('modetransport_id');
            $datacomm['projet_id'] = $project_id;
            $datacomm['detailtransport'] = $this->request->getData('detailtransport');
            $datacomm['nbfergule'] = $this->request->getData('nbfergule');
            $datacomm['remisetotal'] = $this->request->getData('remisetotal');
            $datacomm['datelivraison'] = $this->request->getData('datelivraison');
            $datacomm['methodeexpedition_id'] = $this->request->getData('methodeexpedition_id');
            $datacomm['delailivraison_id'] = $this->request->getData('delailivraison_id');
            $datacomm['conditionreglement_id'] = $this->request->getData('conditionreglement_id');
            $datacomm['banque_id'] = $this->request->getData('banque_id');
            $datacomm['comptesBank_id'] = $this->request->getData('comptesBank_id');

            //debug($datacomm);
            $commandeclient = $this->Commandeclients->patchEntity($commandeclient, $datacomm);
            if ($this->Commandeclients->save($commandeclient)) {
                foreach ($this->request->getData('paiement_id') as $key => $paicom) {
                    $clientpaiement = $this->fetchTable('Clientpaiements')->newEmptyEntity();
                    $dattc['paiement_id'] = $paicom;
                    $dattc['commandeclient_id'] = $commandeclient->id;
                    $clientpaiement = $this->fetchTable('Clientpaiements')->patchEntity($clientpaiement, $dattc);
                    $this->fetchTable('Clientpaiements')->save($clientpaiement);
                }
                //debug($commandeclient);
                $this->misejour("Offre ggb", "add", $commandeclient->id);
                $this->misejour("Offre ggb", "addprojet", $project_id);
                $projet_id = $commandeclient['projet_id'];
                if ($projet_id) {
                    // $this->misejour("Commande client", "add", $projet_id);

                    $this->loadModel('Projets');
                    $projet = $this->Projets->get($projet_id);
                    $datetimeActuelle = FrozenTime::now();
                    $datetimeActuelle->format('Y-m-d H:i:s');
                    $projet->datemodification = $datetimeActuelle;
                    $this->Projets->save($projet);
                }


                $commandeclient_id = $commandeclient->id;

                $session = $this->request->getSession();
                $session->write('com', $commandeclient_id);
            }
            return $this->redirect(['action' => 'vieww/' . $project_id . '/' . $commandeclient_id]);
        }
        $this->loadModel('Clients');
        $this->loadModel('Projets');

        $projet = $this->fetchTable('Projets')->get($project_id);
        $projets = $this->fetchTable('Projets')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $clients = $this->fetchTable('Clients')->find('list', ['keyfield' => 'id', 'valueField' => 'nom']);
        $chauffeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 5 . "%' "]);
        $convoyeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 1 . "%' "]);
        $pointdeventes = $this->Commandeclients->Pointdeventes->find('list', ['limit' => 200]);
        $depots = $this->Commandeclients->Depots->find('list', ['limit' => 200]);
        $cartecarburants = $this->Commandeclients->Cartecarburants->find('list', ['limit' => 200]);
        $materieltransports = $this->Commandeclients->Materieltransports->find('list', ['limit' => 200]);
        $bonlivraisons = $this->Commandeclients->Bonlivraisons->find('list', ['limit' => 200]);
        $this->loadModel('Articles');
        $articles = $this->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Articles.vente = 1"]);
        $devises = $this->fetchTable('Devises')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $incoterms = $this->fetchTable('Incoterms')->find('list', ['keyfield' => 'id', 'valueField' => 'code']);
        $materieltransports = $this->fetchTable('Materieltransports')->find('list', ['limit' => 200]);
        $incotermpdfs = $this->fetchTable('Incoterms')->find('list', ['keyfield' => 'id', 'valueField' => 'code']);
        $this->loadModel('Paiements');
        $paiements = $this->Paiements->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $pays = $this->fetchTable('Pays')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        // debug($fournisseursOptions);
        $modetransports = $this->fetchTable('Modetransports')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $unites = $this->fetchTable('Unites')->find('all');
        $conditionreglements = $this->fetchTable('Conditionreglements')->find('list', ['keyfield' => 'id', 'valueField' => 'conditionn']);
        $delailivraisons = $this->fetchTable('Delailivraisons')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $methodeexpeditions = $this->fetchTable('Methodeexpeditions')->find('list', ['keyfield' => 'id', 'valueField' => 'methode']);
        $banques = $this->fetchTable('Banques')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $parametretaus = $this->fetchTable('Parametretaus')->find('all')->first();
        $this->set(compact('banques', 'parametretaus', 'methodeexpeditions', 'delailivraisons', 'projet', 'conditionreglements', 'project_id', 'paiements', 'unites', 'pays', 'modetransports', 'incotermpdfs', 'code', 'incoterms', 'materieltransports', 'devises', 'lignecommandeclients', 'articles', 'commandeclient', 'clients', 'projets', 'depots', 'cartecarburants', 'materieltransports', 'chauffeurs', 'convoyeurs', 'bonlivraisons'));
    }
    public function viewregfour($id = null)
    {
        $s = $id;
        $this->loadModel('Reglements');
        $this->loadModel('Factures');
        $this->loadModel('Livraisons');
        $this->loadModel('Lignereglements');
        $this->loadModel('Piecereglements');
        $reglement = $this->Reglements->get($id, [
            'contain' => ['Fournisseurs', 'Importations', 'Utilisateurs', 'Exercices', 'Devises', 'Lignereglements', 'Piecereglements'],
        ]);
        $four = $reglement->fournisseur_id;
        $lignesreg = $this->Lignereglements->find('all')->where(['Lignereglements.reglement_id =' . $id])->contain(['Factures']);
        $piecereglements = $this->Piecereglements->find('all')->where(['Piecereglements.reglement_id =' . $id]);
        $mtbon = 0.000;
        $mtfact = 0.000;
        foreach ($lignesreg as $k => $ligne) {
            if ($ligne['facture_id'] != null) {
                $facreg[$ligne['facture_id']] = 1;
                $mtfact = $mtfact + $ligne['Montant'];
            } else {
                $facreg[$ligne['livraison_id']] = 1;
                $mtbon = $mtbon + $ligne['Montant'];
            }
            $project_id = $ligne->facture->projet_id;
        }
        if ($four != null) {
            $this->loadModel('Factures');
            $this->loadModel('Livraisons');
            $factures = $this->Factures->find('all')->where(['Factures.fournisseur_id =' . $four]);
        }
        $this->loadModel('Tos');
        $valeurs = $this->Tos->find('list', ['limit' => 200])->all();
        $this->loadModel('Paiements');
        $paiements = $this->Paiements->find('list', ['limit' => 200])->all();
        $this->loadModel('Carnetcheques');
        $carnetcheques = $this->Carnetcheques->find('list', ['limit' => 200])->all();
        $pointdeventes = $this->Reglements->Pointdeventes->find('list', ['limit' => 200])->all();
        $fournisseurs = $this->Reglements->Fournisseurs->find('list', ['limit' => 200])->all();
        $fournisseurs = $this->Reglements->Fournisseurs->find('list', ['limit' => 200])->all();
        $importations = $this->Reglements->Importations->find('list', ['limit' => 200])->all();
        $utilisateurs = $this->Reglements->Utilisateurs->find('list', ['limit' => 200])->all();
        $exercices = $this->Reglements->Exercices->find('list', ['limit' => 200])->all();
        $devises = $this->Reglements->Devises->find('list', ['limit' => 200])->all();
        $banques = $this->fetchTable('Banques')->find('list', ['keyField' => 'id', 'valueField' => 'name']);
        $comptes = $this->fetchTable('ComptesBank')->find('list', ['keyField' => 'id', 'valueField' => 'compte']);
        $this->set(compact('project_id', 'banques', 'comptes', 'mtfact', 'mtbon', 'facreg', 'piecereglements', 's', 'lignesreg', 'pointdeventes', 'valeurs', 'carnetcheques', 'paiements', 'p', 'four', 'livraisons', 'factures', 'reglement', 'fournisseurs', 'importations', 'utilisateurs', 'exercices', 'devises'));
    }
    public function deleteregcli($id = null, $project_id = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_vente' . $abrv);
        $reglementclient = 0;
        foreach ($liendd as $k => $liens) {
            if (@$liens['lien'] == 'reglementclients') {
                $reglementclient = $liens['supp'];
            }
        }
        if (($reglementclient <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $this->loadModel('Reglementclients');
        $this->loadModel('Lignereglementclients');
        $this->loadModel('Piecereglementclients');

        $this->loadModel('Factureclients');
        $this->request->allowMethod(['post', 'delete']);
        $ligne1 = $this->Lignereglementclients->find('all', [])->where(['Lignereglementclients.reglementclient_id =' . $id]);
        foreach ($ligne1 as $l) {
            $factureclient_id = $l['factureclient_id'];
            // debug($l);
            $this->Lignereglementclients->delete($l);
            if ($l['factureclient_id'] != null) {
                $fact = $this->Factureclients->get($l['factureclient_id']);

                $mtg = $this->Factureclients->find()->select([
                    "mtreg" =>
                    'Factureclients.Montant_Regler'
                ])->where(['Factureclients.id =' . $l['factureclient_id']])->first();
                $MontantRegler = $mtg->mtreg;
                // debug($MontantRegler);
                $mont = $MontantRegler - $l['Montant'];
                $fact->Montant_Regler = $mont;
                // debug($mont);


                $fact->poste = 0;
                // debug($fact);die;
                $this->Factureclients->save($fact);
                // debug($fact);

            }
        }

        $lignes2 = $this->Piecereglementclients->find()->where(["Piecereglementclients.reglementclient_id=" . $id])->all();
        foreach ($lignes2 as $item) {

            $this->Piecereglementclients->delete($item);
        }
        // $factt = $this->Factureclients->get($factureclient_id);
        // debug($factt);die;
        // $factt->poste = 0;
        // $this->Factureclients->save($factt);
        $reglementclient = $this->Reglementclients->get($id);


        if ($this->Reglementclients->delete($reglementclient)) {
            $this->misejour("ReglementClients", "delete", $id);
            $projet_id = $reglementclient['projet_id'];
            $this->loadModel('Projets');
            $projet = $this->Projets->get($projet_id);
            $datetimeActuelle = FrozenTime::now();
            $datetimeActuelle->format('Y-m-d H:i:s');
            $projet->datemodification = $datetimeActuelle;
            $this->Projets->save($projet);
        } else {
        }
        return $this->redirect(['action' => 'vieww/', $project_id]);
    }
    public function deleteregfour($id = null, $project_id = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $lien_achat = $session->read('lien_achat' . $abrv);
        $reglement = 0;
        foreach ($lien_achat as $k => $liens) {
            if (@$liens['lien'] == 'reglements') {
                $reglement = $liens['supp'];
            }
        }
        if (($reglement <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $this->loadModel('Reglements');
        $this->loadModel('Factures');
        $this->loadModel('Livraisons');
        $this->loadModel('Lignereglements');
        $this->loadModel('Piecereglements');
        $lignes = $this->Lignereglements->find()
            ->where(["reglement_id" => $id])
            ->contain('Factures')
            ->all();
        $pieces = $this->Piecereglements->find()->where(["reglement_id" => $id])->all();
        foreach ($lignes as $item) {
            if ($item['facture_id'] != null) {
                $mtg = $this->Factures->find()->select([
                    "mtreg" =>
                    'Factures.Montant_Regler'
                ])->where(['Factures.id =' . $item['facture_id']])->first();
                $MontantRegler = $mtg->mtreg;
                $fact = $this->Factures->get($item['facture_id']);
                $fact->Montant_Regler = $MontantRegler - $item['Montant'];
                $this->Factures->save($fact);
            }
            if ($item['livraison_id'] != null) {
                $mtg = $this->Livraisons->find()->select([
                    "mtreg" =>
                    'Livraisons.Montant_Regler'
                ])->where(['Livraisons.id =' . $item['livraison_id']])->first();
                $MontantRegler = $mtg->mtreg;
                $fact = $this->Livraisons->get($item['livraison_id']);
                $fact->Montant_Regler = $MontantRegler - $item['Montant'];
                $this->Livraisons->save($fact);
            }
            $this->Lignereglements->delete($item);

            $project_id = $item->facture->projet_id;
        }
        foreach ($pieces as $piece) {
            $this->Piecereglements->delete($piece);
        }
        $reglement = $this->Reglements->get($id);
        $fact = $this->Factures->get($item['facture_id']);
        if ($this->Reglements->delete($reglement)) {
            $this->misejour("Reglements Fournisseur", "delete", $id);
            $fact->valide = 0;
            $this->Factures->save($fact);
            $projet_id = $reglement['projet_id'];
            $this->loadModel('Projets');
            $projet = $this->Projets->get($projet_id);
            $datetimeActuelle = FrozenTime::now();
            $datetimeActuelle->format('Y-m-d H:i:s');
            $projet->datemodification = $datetimeActuelle;
            $this->Projets->save($projet);
        } else {
        }

        return $this->redirect(['action' => 'vieww/', $project_id]);
    }
    public function editregfour($id = null, $project_id = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $lien_achat = $session->read('lien_achat' . $abrv);
        $reglement = 0;
        foreach ($lien_achat as $k => $liens) {
            if (@$liens['lien'] == 'reglements') {
                $reglement = $liens['modif'];
            }
        }
        if (($reglement <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $this->loadModel('Reglements');
        $this->loadModel('Factures');
        $this->loadModel('Livraisons');
        $this->loadModel('Lignereglements');
        $this->loadModel('Piecereglements');
        $reglement = $this->Reglements->get($id, []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data['numeroconca'] = $this->request->getData('numeroconca');
            $data['Date'] = $this->request->getData('Date');
            $data['fournisseur_id'] = $this->request->getData('fournisseur_id');
            $data['pointdevente_id'] = $this->request->getData('pointdevente_id');
            $data['Montant'] = $this->request->getData('data')['Reglement']['Montant'];
            $reglement = $this->Reglements->patchEntity($reglement, $data);
            if ($this->Reglements->save($reglement)) {
                $this->misejour("Reglements", "edit", $id);
                $projet_id = $reglement['projet_id'];
                $this->loadModel('Projets');
                $projet = $this->Projets->get($projet_id);
                $datetimeActuelle = FrozenTime::now();
                $datetimeActuelle->format('Y-m-d H:i:s');
                $projet->datemodification = $datetimeActuelle;
                $this->Projets->save($projet);
                $lignes = $this->Lignereglements->find()
                    ->where(["reglement_id" => $id])
                    ->contain('Factures')
                    ->all();
                foreach ($lignes as $item) {
                    if ($item['facture_id'] != null) {
                        $mtg = $this->Factures->find()->select([
                            "mtreg" =>
                            'Factures.Montant_Regler'
                        ])->where(['Factures.id =' . $item['facture_id']])->first();
                        $MontantRegler = $mtg->mtreg;
                        $fact = $this->Factures->get($item['facture_id']);
                        $fact->Montant_Regler = $MontantRegler - $item['Montant'];
                        $this->Factures->save($fact);
                    }
                    if ($item['livraison_id'] != null) {
                        $mtg = $this->Livraisons->find()->select([
                            "mtreg" =>
                            'Livraisons.Montant_Regler'
                        ])->where(['Livraisons.id =' . $item['livraison_id']])->first();
                        $MontantRegler = $mtg->mtreg;
                        $fact = $this->Livraisons->get($item['livraison_id']);
                        $fact->Montant_Regler = $MontantRegler - $item['Montant'];
                        $this->Livraisons->save($fact);
                    }
                    $project_id = $item->facture->projet_id;
                    $this->Lignereglements->delete($item);
                }

                if (isset($this->request->getData('data')['Lignereglement']) && (!empty($this->request->getData('data')['Lignereglement']))) {
                    foreach ($this->request->getData('data')['Lignereglement'] as $i => $l) {
                        if (isset($l['facture_id'])) {
                            $ta = $this->fetchTable('Lignereglements')->newEmptyEntity();
                            $ta['reglement_id'] = $id;
                            $ta['facture_id'] = $l['facture_id'];
                            $ta['Montant'] = $l['Montanttt'];
                            $mtg = $this->Factures->find()->select([
                                "mtreg" => 'Factures.Montant_Regler'
                            ])->where(['Factures.id =' . $l['facture_id']])->first();
                            $MontantRegler = $mtg->mtreg;
                            $fact = $this->Factures->get($l['facture_id']);
                            $fact->Montant_Regler = $MontantRegler + $l['Montanttt'];
                            $this->Factures->save($fact);
                            $this->fetchTable('Lignereglements')->save($ta);
                        }
                        if (isset($l['bonreception_id'])) {
                            $tabb = $this->fetchTable('Lignereglements')->newEmptyEntity();
                            $tabb['reglement_id'] = $id;
                            $tabb['livraison_id'] = $l['bonreception_id'];
                            $tabb['Montant'] = $l['ttc'];
                            $this->fetchTable('Lignereglements')->save($tabb);
                            $mtg = $this->Livraisons->find()->select([
                                "mtreg" =>
                                'Livraisons.Montant_Regler'
                            ])->where(['Livraisons.id =' . $l['bonreception_id']])->first();
                            $MontantRegler = $mtg->mtreg;
                            $fact = $this->Livraisons->get($l['bonreception_id']);
                            $fact->Montant_Regler = $MontantRegler + $l['ttc'];
                            $this->Livraisons->save($fact);
                        }
                    }
                }
                $lignes2 = $this->Piecereglements->find()->where(["reglement_id" => $id])->all();
                foreach ($lignes2 as $item) {
                    $this->Piecereglements->delete($item);
                }
                if (isset($this->request->getData('data')['pieceregelemnt']) && (!empty($this->request->getData('data')['pieceregelemnt']))) {
                    foreach ($this->request->getData('data')['pieceregelemnt'] as $j => $p) {
                        if (isset($p['sup']) && $p['sup'] != 1) {
                            $tab = $this->fetchTable('Piecereglements')->newEmptyEntity();
                            $tab['reglement_id'] = $id;
                            $tab['paiement_id'] = $p['paiement_id'];
                            $tab['banque_id'] = $p['banque_id'];
                            $tab['montant'] = $p['montant'];
                            $tab['compte_id'] = $p['compte'];
                            $tab['to_id'] = $p['taux'];
                            $tab['montant_net'] = $p['montantnet'];
                            $tab['echance'] = $p['echance'];
                            $tab['carnetcheque_id'] = $p['carnetcheque_id'];
                            $tab['num'] = $p['num_piece'];
                            $this->fetchTable('Piecereglements')->save($tab);
                        }
                    }
                }
                return $this->redirect(['action' => 'editregfour/', $id, $project_id]);
            }
        }
        $four = $reglement->fournisseur_id;
        $p = $reglement->pointdevente_id;
        $lignesreg = $this->Lignereglements->find('all')->where(['Lignereglements.reglement_id =' . $id]);
        $piecereglements = $this->Piecereglements->find('all')->where(['Piecereglements.reglement_id =' . $id]);
        $mtbon = 0.000;
        $mtfact = 0.000;
        foreach ($lignesreg as $k => $ligne) {
            if ($ligne['facture_id'] != null) {
                $facreg[$ligne['facture_id']] = 1;
                $mtfact = $mtfact + $ligne['Montant'];
            } else {
                $facreg[$ligne['livraison_id']] = 1;
                $mtbon = $mtbon + $ligne['Montant'];
            }
        }
        if ($four != null && $p != null) {
            $this->loadModel('Factures');
            $this->loadModel('Livraisons');
            $factures = $this->Factures->find('all')->where(['Factures.projet_id =' . $project_id]);
            $livraisons = $this->Livraisons->find('all')->where(['Livraisons.fournisseur_id =' . $four, 'Livraisons.pointdevente_id =' . $p]);
        }
        if ($four != null && $p == null) {
            $this->loadModel('Factures');
            $this->loadModel('Livraisons');
            $factures = $this->Factures->find('all')->where(['Factures.projet_id =' . $project_id /*,'Factures.pointdevente_id'=>$p*/]);
        }
        $this->loadModel('Tos');
        $valeurs = $this->Tos->find('list', ['limit' => 200])->all();
        $this->loadModel('Paiements');
        $paiements = $this->Paiements->find('list', ['limit' => 200])->all();
        $this->loadModel('Carnetcheques');
        $carnetcheques = $this->Carnetcheques->find('list', ['limit' => 200])->all();
        $comptes = $this->fetchTable('ComptesBank')->find('list', ['keyField' => 'id', 'valueField' => 'compte']);
        $pointdeventes = $this->Reglements->Pointdeventes->find('list', ['limit' => 200])->all();
        $fournisseurs = $this->Reglements->Fournisseurs->find('list', ['limit' => 200])->all();
        $fournisseurs = $this->Reglements->Fournisseurs->find('list', ['limit' => 200])->all();
        $importations = $this->Reglements->Importations->find('list', ['limit' => 200])->all();
        $utilisateurs = $this->Reglements->Utilisateurs->find('list', ['limit' => 200])->all();
        $exercices = $this->Reglements->Exercices->find('list', ['limit' => 200])->all();
        $banques = $this->fetchTable('Banques')->find('all', ['keyField' => 'id', 'valueField' => 'name']);
        $devises = $this->Reglements->Devises->find('list', ['limit' => 200])->all();
        $this->set(compact('project_id', 'banques', 'comptes', 'mtfact', 'mtbon', 'facreg', 'id', 'piecereglements', 'lignesreg', 'pointdeventes', 'valeurs', 'carnetcheques', 'paiements', 'p', 'four', 'livraisons', 'factures', 'reglement', 'fournisseurs', 'importations', 'utilisateurs', 'exercices', 'devises'));
    }
    public function deletefacfour($id = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_achat' . $abrv);
        $fournisseur = 0;
        foreach ($liendd as $k => $liens) {
            if (@$liens['lien'] == 'factures') {
                $fournisseur = $liens['supp'];
            }
        }
        if (($fournisseur <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $this->loadModel('Factures');

        $this->loadModel('Lignefactures');
        $facture = $this->Factures->get($id);
        $project_id = $facture->projet_id;
        $this->loadModel('Commandefournisseurs');
        $commfour = $this->Commandefournisseurs->find("All")->where("facture_id=" . $id)->first();
        // debug($id);
        $commfour->facture_id = null;
        // $commfour->valide = 0;
        $this->Commandefournisseurs->save($commfour);
        // debug($commfour);
        $this->loadModel('Factures');
        if ($this->Factures->delete($facture)) {
            debug("hello");
            $this->misejour("Facture", "delete", $id);
            $projet_id = $facture['projet_id'];
            $this->loadModel('Projets');
            $projet = $this->Projets->get($projet_id);
            $datetimeActuelle = FrozenTime::now();
            $datetimeActuelle->format('Y-m-d H:i:s');
            $projet->datemodification = $datetimeActuelle;
            $this->Projets->save($projet);
            $lignefactures = $this->Lignefactures->find('all', [])
                ->where(['facture_id' => $id]);
            foreach ($lignefactures as $c) {
                $this->Lignefactures->delete($c);
            }
        }
        return $this->redirect(['action' => 'vieww/' . $project_id]);
    }
    public function viewfacfour($id = null)
    {
        $this->loadModel('Factures');

        $facture = $this->Factures->get($id, [
            'contain' => []
        ]);
        $project_id = $facture->projet_id;

        $this->loadModel('Lignefactures');
        if ($this->request->is(['patch', 'post', 'put'])) {
            $facture = $this->Factures->patchEntity($facture, $this->request->getData());
            if ($this->Factures->save($facture)) {
                $this->loadModel('Lignefactures');
                $articles_ids = $this->request->getData('articles_ids');
                $codefs = $this->request->getData('codef');
                $qtes = $this->request->getData('qte');
                $prixhts = $this->request->getData('prixht');
                $remises = $this->request->getData('remise');
                $prixunhts = $this->request->getData('prixunht');
                $fodecs = $this->request->getData('fodec');
                $tvas = $this->request->getData('tva');
                $ttcs = $this->request->getData('ttc');
                $lignes = $this->Lignefactures->find()->where(["Facture_id" => $id])->all();
                foreach ($lignes as $item) {
                    $this->Lignefactures->delete($item);
                }
                if (isset($this->request->getData('data')['tabligne3']) && (!empty($this->request->getData('data')['tabligne3']))) {
                    $this->loadModel('Lignefactures');
                    foreach ($this->request->getData('data')['tabligne3'] as $i => $liv) {
                        if ($liv['sup'] != 1) {
                            $data['article_id'] = $liv['article_id'];
                            $data['facture_id'] = $id;
                            $data['qteliv'] = $liv['qte'];
                            $data['prix'] = $liv['prix'];
                            $data['remise'] = $liv['remise'];
                            $data['ht'] = $liv['ht'];
                            $data['tva'] = $liv['tva'];
                            $data['fodec'] = $liv['fodec'];
                            $data['ttc'] = $liv['ttc'];
                            $lignefactures = $this->fetchTable('Lignefactures')->newEmptyEntity();
                            $Lignefactures = $this->Lignefactures->patchEntity($lignefactures, $data);
                            if ($this->Lignefactures->save($lignefactures)) {
                            } else {
                                $this->Flash->error("Failed to create Lignefactures");
                            }
                        }
                        $this->set(compact("Lignefactures"));
                    }
                }
                return $this->redirect(['action' => 'vieww/', $project_id]);
            }
        }
        $this->loadModel('Conteneurs');
        $conteneur = $this->fetchTable('Conteneurs')->find('list', ['keyfield' => 'id', 'valueField' => 'Identifiant']);
        $fournisseurs = $this->Factures->Fournisseurs->find('list', ['limit' => 200]);
        $depots = $this->Factures->Depots->find('list', ['limit' => 200]);
        $cartecarburants = $this->Factures->Cartecarburants->find('list', ['limit' => 200]);
        $materieltransports = $this->Factures->Materieltransports->find('list', ['limit' => 200]);
        $lignes = $this->Lignefactures->find()->where(["Facture_id" => $id])->all();
        $count = $this->Lignefactures->find()->where(["Facture_id" => $id])->count();
        $adresselivraisonfournisseurs = $this->Factures->Adresselivraisonfournisseurs->find('list', ['keyfield' => 'id', 'valueField' => 'adresse']);
        $this->loadModel('Articles');
        $this->loadModel('Personnels');
        $incoterms = $this->fetchTable('Incoterms')->find('list', ['keyfield' => 'id', 'valueField' => 'code']);
        $articles = $this->Articles->find('all');
        $chauffeurs = $this->Personnels->find('all')->where(["Personnels.fonction_id  ='" . 5 . "%' "]);
        $conffaieurs = $this->Personnels->find('all')->where(["Personnels.fonction_id ='" . 1 . "%' "]);
        $this->set(compact('project_id', 'conteneur', 'incoterms', 'conffaieurs', 'chauffeurs', 'facture', 'lignes', 'count', 'articles', 'fournisseurs', 'adresselivraisonfournisseurs', 'pointdeventes', 'depots', 'cartecarburants', 'materieltransports'));
    }
    public function editfacfour($id = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_achat' . $abrv);
        $fournisseur = 0;
        foreach ($liendd as $k => $liens) {
            if (@$liens['lien'] == 'factures') {
                $fournisseur = $liens['modif'];
            }
        }
        if (($fournisseur <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $this->loadModel('Factures');
        $facture = $this->Factures->get($id, [
            'contain' => []
        ]);
        $project_id = $facture->projet_id;
        $this->loadModel('Factures');
        $this->loadModel('Lignefactures');
        if ($this->request->is(['patch', 'post', 'put'])) {
            $facture = $this->Factures->patchEntity($facture, $this->request->getData());

            if ($this->Factures->save($facture)) {
                $this->misejour("Facture", "edit", $id);
                $projet_id = $facture['projet_id'];
                $this->loadModel('Projets');
                $projet = $this->Projets->get($projet_id);
                $datetimeActuelle = FrozenTime::now();
                $datetimeActuelle->format('Y-m-d H:i:s');
                $projet->datemodification = $datetimeActuelle;
                $this->Projets->save($projet);
                $this->loadModel('Lignefactures');
                $articles_ids = $this->request->getData('articles_ids');
                $codefs = $this->request->getData('codef');
                $qtes = $this->request->getData('qte');
                $prixhts = $this->request->getData('prixht');
                $remises = $this->request->getData('remise');
                $prixunhts = $this->request->getData('prixunht');
                $fodecs = $this->request->getData('fodec');
                $tvas = $this->request->getData('tva');
                $ttcs = $this->request->getData('ttc');
                $lignes = $this->Lignefactures->find()->where(["Facture_id" => $id])->all();
                if (isset($this->request->getData('data')['tabligne3']) && (!empty($this->request->getData('data')['tabligne3']))) {
                    $this->loadModel('Lignefactures');
                    foreach ($this->request->getData('data')['tabligne3'] as $i => $liv) {
                        $data['article_id'] = $liv['article_id'];
                        $data['facture_id'] = $id;
                        $data['qte'] = $liv['qte'];
                        $data['prix'] = $liv['prix'];
                        $data['remise'] = $liv['remise'];
                        $data['punht'] = $liv['punht'];
                        $data['tva'] = $liv['tva'];
                        $data['fodec'] = $liv['fodec'];
                        $data['ttc'] = $liv['ttc'];
                        $lignefactures = $this->fetchTable('Lignefactures')->get($liv['id']);
                        $Lignefactures = $this->Lignefactures->patchEntity($lignefactures, $data);
                        $lignefacture = $this->fetchTable('Lignefactures')->patchEntity($Lignefactures, $data);
                        $this->fetchTable('Lignefactures')->save($lignefacture);
                        $this->set(compact("Lignefactures"));
                    }
                }
                $lignefacture = $this->Factures->Lignefactures->find('all', [
                    'contain' => ['Articles']
                ])->where(['facture_id' => $id]);
                return $this->redirect(['action' => 'editfacfour/', $id]);
            }
        }
        $fournisseurs = $this->Factures->Fournisseurs->find('list', ['limit' => 200]);
        $depots = $this->Factures->Depots->find('list', ['limit' => 200]);
        $cartecarburants = $this->Factures->Cartecarburants->find('list', ['limit' => 200]);
        $materieltransports = $this->Factures->Materieltransports->find('list', ['limit' => 200]);
        $lignes = $this->Lignefactures->find()->where(["facture_id" => $id])->all();
        $count = $this->Lignefactures->find()->where(["facture_id" => $id])->count();
        $adresselivraisonfournisseurs = $this->Factures->Adresselivraisonfournisseurs->find('list', ['keyfield' => 'id', 'valueField' => 'adresse']);
        $this->loadModel('Articles');
        $this->loadModel('Personnels');
        $articles = $this->Articles->find('all');
        $this->loadModel('Conteneurs');
        $timbres = $this->fetchTable('Timbres')->find('list', ['keyfield' => 'id', 'valueField' => 'timbre']);
        $incoterms = $this->fetchTable('Incoterms')->find('list', ['keyfield' => 'id', 'valueField' => 'code']);
        $projets = $this->fetchTable('Projets')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $conteneur = $this->fetchTable('Conteneurs')->find('list', ['keyfield' => 'id', 'valueField' => 'Identifiant']);
        $chauffeurs = $this->Personnels->find('all')->where(["Personnels.fonction_id  ='" . 5 . "%' "]);
        $conffaieurs = $this->Personnels->find('all')->where(["Personnels.fonction_id ='" . 1 . "%' "]);
        $this->set(compact('timbres', 'incoterms', 'projets', 'project_id', 'conteneur', 'conffaieurs', 'chauffeurs', 'facture', 'lignes', 'count', 'articles', 'fournisseurs', 'adresselivraisonfournisseurs', 'pointdeventes', 'depots', 'cartecarburants', 'materieltransports'));
    }
    public function editcomfour($id = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_achat' . $abrv);
        $cmd = 0;
        foreach ($liendd as $k => $liens) {
            if (@$liens['lien'] == 'commandes') {
                $cmd = $liens['modif'];
            }
        }
        if (($cmd <> 1)) {
            $this->redirect(array('controller' => 'Users', 'action' => 'login'));
        }
        $this->loadModel('Commandefournisseurs');
        $this->loadModel('Lignecommandefournisseurs');
        $this->loadModel('Paiements');
        $this->loadModel('Devises');
        $this->loadModel('Conditionreglements');
        $this->loadModel('Methodeexpeditions');
        $this->loadModel('Demandeoffredeprixes');
        $commande = $this->Commandefournisseurs->get($id, [
            'contain' => []
        ]);

        $this->loadModel('Commandefournisseurs');
        $project_id = $commande->projet_id;
        $type = $commande->typecommande;
        if ($this->request->is(['patch', 'post', 'put'])) {
            $num = $this->Commandefournisseurs->find()->select([
                "numdepot" =>
                'MAX(Commandefournisseurs.numero)'
            ])->first();
            $numero = $num->numdepot;
            $n = 0;
            $n = $numero;
            if (!empty($n)) {
                $ff = intval(substr($n, 3, 7)) + 1;
                $z = str_pad("$ff", 5, '0', STR_PAD_LEFT);
                $b = str_pad("$z", 6, 'C', STR_PAD_LEFT);
            } else {
                $n = "C00001";
                $z = str_pad(" $n", 5, '0', STR_PAD_LEFT);
                $b = str_pad("$z", 6, 'C', STR_PAD_LEFT);
            }
            $this->set(compact('b'));
            $commande = $this->Commandefournisseurs->patchEntity($commande, $this->request->getData());
            if ($this->Commandefournisseurs->save($commande)) {
                $cmd_id = ($this->Commandefournisseurs->save($commande)->id);
                $ff = $this->fetchTable('Fournisseurpaiementcommandes')->find('all')->where(['Fournisseurpaiementcommandes.commandefournisseur_id=' . $cmd_id]);
                foreach ($ff as $f) {
                    $this->fetchTable('Fournisseurpaiementcommandes')->delete($f);
                }
                if ((!empty($this->request->getData('paim'))) && ($this->request->getData('paim') != '')) {
                    $pieces = explode(", ", $this->request->getData('paim'));

                    foreach ($pieces as $key => $piece) {
                        $pp = $this->Paiements->find('all')->where(['Paiements.name ="' . $piece . '"'])->first();
                        if (!empty($pp)) {
                            $fournisseurpaiement = $this->fetchTable('Fournisseurpaiementcommandes')->newEmptyEntity();
                            $dattc['paiement_id'] = $pp['id'];
                            $dattc['commandefournisseur_id'] = $cmd_id;
                            $datc['fournisseur_id'] = $this->request->getData('fournisseur_id');

                            $fournisseurpaiement = $this->fetchTable('Fournisseurpaiementcommandes')->patchEntity($fournisseurpaiement, $dattc);
                            $this->fetchTable('Fournisseurpaiementcommandes')->save($fournisseurpaiement);
                        }
                    }
                }
                if ((!empty($this->request->getData('paiement_id'))) && ($this->request->getData('paiement_id') != '')) {
                    $fournisseurpaiement = $this->fetchTable('Fournisseurpaiementcommandes')->newEmptyEntity();
                    $datc['paiement_id'] = $this->request->getData('paiement_id');
                    $datc['commandefournisseur_id'] = $cmd_id;
                    $datc['fournisseur_id'] = $this->request->getData('fournisseur_id');

                    $fournisseurpaiement = $this->fetchTable('Fournisseurpaiementcommandes')->patchEntity($fournisseurpaiement, $datc);
                    $this->fetchTable('Fournisseurpaiementcommandes')->save($fournisseurpaiement);
                }
                $this->misejour("Commandefournisseurs", "edit", $cmd_id);

                $projet_id = $commande['projet_id'];
                $this->misejour("Commandefournisseurs", "editprojet", $projet_id);
                $this->loadModel('Projets');
                $projet = $this->Projets->get($projet_id);
                $datetimeActuelle = FrozenTime::now();
                $datetimeActuelle->format('Y-m-d H:i:s');
                $projet->datemodification = $datetimeActuelle;
                $this->Projets->save($projet);
                $commande_id = $commande->id;
                $lignecmd = $this->Lignecommandefournisseurs->find('all', [])
                    ->where(["Lignecommandefournisseurs.commandefournisseur_id  ='" . $id . "'"]);
                foreach ($lignecmd as $c) {
                    $this->Commandefournisseurs->Lignecommandefournisseurs->delete($c);
                }
                if (isset($this->request->getData('data')['ligner']) && (!empty($this->request->getData('data')['ligner']))) {
                    $this->loadModel('Commandefournisseurs');
                    foreach ($this->request->getData('data')['ligner'] as $i => $commande) {
                        if ($commande['sup0'] != 1) {
                            $data['commandefournisseur_id'] = $commande_id;
                            $data['fournisseur_id'] = $this->request->getData('fournisseur_id');
                            $data['date'] = date('d-m-y');
                            $data['qte'] = $commande['qte'];
                            $data['prix'] = $commande['prix'];
                            $data['ht'] = $commande['punht'];
                            $data['article_id'] = $commande['article_id'];
                            $data['remise'] = $commande['remise'];
                            $data['fodec'] = $commande['fodec'];
                            $data['tva'] = $commande['tva'];
                            $data['ttc'] = $commande['ttc'];
                            $cd = $this->fetchTable('Lignecommandefournisseurs')->newEmptyEntity();
                            $cd = $this->Lignecommandefournisseurs->patchEntity($cd, $data);
                            if ($this->Lignecommandefournisseurs->save($cd)) {
                            } else {
                            }
                            $this->set(compact("cd"));
                        }
                    }
                }
                return $this->redirect(['action' => 'editcomfour/', $id]);
            }
        }
        $lignecommandes = $this->Commandefournisseurs->Lignecommandefournisseurs->find('all', [
            'contain' => ['Articles']
        ])
            ->where(['commandefournisseur_id' => $id]);
        $demandeoffredeprixes = $this->Commandefournisseurs->Demandeoffredeprixes->find('list', ['limit' => 200]);
        $depots = $this->Commandefournisseurs->Depots->find('list', ['limit' => 200]);
        $cartecarburants = $this->Commandefournisseurs->Cartecarburants->find('list', ['limit' => 200]);
        $materieltransports = $this->Commandefournisseurs->Materieltransports->find('list', ['limit' => 200]);
        $articles = $this->Commandefournisseurs->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'nom']);
        $this->loadModel('Conteneurs');
        $conteneur = $this->fetchTable('Conteneurs')->find('list', ['keyfield' => 'id', 'valueField' => 'Identifiant']);
        $this->loadModel('Fournisseurs');
        $this->loadModel('Projets');
        $projets = $this->fetchTable('Projets')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $fournisseurs = $this->fetchTable('Fournisseurs')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        // $devises = $this->fetchTable('Devises')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $devises = $this->fetchTable('Devises')->find('list', [
            'keyfield' => 'id',
            'valueField' => function ($d) {
                return $d->name . ' (' . $d->symbole . ')';
            }
        ]);
        $incoterms = $this->fetchTable('Incoterms')->find('list', ['keyfield' => 'id', 'valueField' => 'code']);
        $paiements = $this->Paiements->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $devises = $this->Devises->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $conditionreglements = $this->Conditionreglements->find('list', ['keyfield' => 'id', 'valueField' => 'conditionn']);
        $methodeexpeditions = $this->Methodeexpeditions->find('list', ['keyfield' => 'id', 'valueField' => 'methode']);
        $this->set(compact('paiements', 'devises', 'conditionreglements', 'methodeexpeditions', 'project_id', 'devises', 'incoterms', 'conteneur', 'commande', 'lignecommandes', 'projets', 'articles', 'demandeoffredeprixes', 'fournisseurs', 'depots', 'cartecarburants', 'materieltransports', 'type'));
    }
    public function addcmdf($project_id = null)
    {
        // $projet_id = $project_id;
        // $this->set(compact("projet_id"));
        // debug($project_id);
        $this->paginate = [
            'contain' => ['Demandeoffredeprixes', 'Articles', 'Fournisseurs'],
        ];
        $this->loadModel('Commandefournisseurs');
        $this->loadModel('Lignecommandefournisseurs');
        $this->loadModel('Fournisseurs');
        $this->loadModel('Pointdeventes');
        $this->loadModel('Lignecommandefournisseurs');
        $this->loadModel('Depots');
        $this->loadModel('Devises');
        $this->loadModel('Paiements');
        $this->loadModel('Devises');
        $this->loadModel('Conditionreglements');
        $this->loadModel('Methodeexpeditions');
        $this->loadModel('Demandeoffredeprixes');
        $num = $this->Commandefournisseurs->find()->select([
            "numdepot" =>
            'MAX(Commandefournisseurs.numero)'
        ])->first();
        $numero = $num->numdepot;
        $n = 0;
        $n = $numero;
        if (!empty($n)) {
            $ff = intval(substr($n, 3, 7)) + 1;
            $z = str_pad("$ff", 5, '0', STR_PAD_LEFT);
            $b = str_pad("$z", 6, 'C', STR_PAD_LEFT);
        } else {
            $n = "C00001";
            $z = str_pad(" $n", 5, '0', STR_PAD_LEFT);
            $b = str_pad("$z", 6, 'C', STR_PAD_LEFT);
        }
        $this->set(compact('b'));
        $commande = $this->fetchTable('Commandefournisseurs')->newEmptyEntity();

        if ($this->request->is('post') || $this->request->is('put')) {
            $data['devise_id'] = $this->request->getData('devise_id');
            $data['incoterm_id'] = $this->request->getData('incoterm_id');
            $data['conteneur_id'] = $this->request->getData('conteneur_id');
            $data['dateprev'] = $this->request->getData('dateprev');
            $data['date'] = $this->request->getData('date');
            $data['numero'] = $this->request->getData('numero');
            $data['fournisseur_id'] = $this->request->getData('fournisseur_id');
            $data['depot_id'] = $this->request->getData('depot_id');
            $data['projet_id'] = $this->request->getData('projet_id');
            $data['tvaOnOff'] = $this->request->getData('tvaOnOff');
            $data['fodec'] = $this->request->getData('fodec');
            $data['ht'] = $this->request->getData('ht');
            $data['tva'] = $this->request->getData('tva');
            $data['ttc'] = $this->request->getData('ttc');
            $data['remise'] = $this->request->getData('remise');
            $data['pay'] = $this->request->getData('pay');
            $data['tauxdechange'] = $this->request->getData('tauxdechange');
            $data['conditionreglement_id'] = $this->request->getData('conditionreglement_id');
            $data['methodeexpedition_id'] = $this->request->getData('methodeexpedition_id');
            $data['nbfergule'] = $this->request->getData('nbfergule');
            $data['detailmontantpdf'] = $this->request->getData('detailmontantpdf');
            $data['incotermpdf_id'] = $this->request->getData('incotermpdf_id');

            $commande = $this->Commandefournisseurs->patchEntity($commande, $data);
            // debug($commande);
            if ($this->Commandefournisseurs->save($commande)) {
                //debug($commande);

                // debug($projet_id);die;
                $projet = $this->Projets->get($project_id);
                $datetimeActuelle = FrozenTime::now();
                $datetimeActuelle->format('Y-m-d H:i:s');
                $projet->datemodification = $datetimeActuelle;
                $this->Projets->save($projet);

                $cmd_id = ($this->Commandefournisseurs->save($commande)->id);
                if ((!empty($this->request->getData('paim'))) && ($this->request->getData('paim') != '')) {
                    $pieces = explode(", ", $this->request->getData('paim'));

                    foreach ($pieces as $key => $piece) {
                        $pp = $this->Paiements->find('all')->where(['Paiements.name ="' . $piece . '"'])->first();
                        if (!empty($pp)) {
                            $fournisseurpaiement = $this->fetchTable('Fournisseurpaiementcommandes')->newEmptyEntity();
                            $dattc['paiement_id'] = $pp['id'];
                            $dattc['commandefournisseur_id'] = $cmd_id;
                            $datc['fournisseur_id'] = $this->request->getData('fournisseur_id');

                            $fournisseurpaiement = $this->fetchTable('Fournisseurpaiementcommandes')->patchEntity($fournisseurpaiement, $dattc);
                            $this->fetchTable('Fournisseurpaiementcommandes')->save($fournisseurpaiement);
                        }
                    }
                }
                if ((!empty($this->request->getData('paiement_id'))) && ($this->request->getData('paiement_id') != '')) {
                    $fournisseurpaiement = $this->fetchTable('Fournisseurpaiementcommandes')->newEmptyEntity();
                    $datc['paiement_id'] = $this->request->getData('paiement_id');
                    $datc['commandefournisseur_id'] = $cmd_id;
                    $datc['fournisseur_id'] = $this->request->getData('fournisseur_id');

                    $fournisseurpaiement = $this->fetchTable('Fournisseurpaiementcommandes')->patchEntity($fournisseurpaiement, $datc);
                    $this->fetchTable('Fournisseurpaiementcommandes')->save($fournisseurpaiement);
                }
                $this->misejour("Commandefournisseurs", "add", $cmd_id);
                $this->misejour("Commandefournisseurs", "addprojet", $project_id);

                // $lignecmd = $this->Lignecommandefournisseurs->find('all', [])
                //     ->where(["Lignecommandefournisseurs.commandefournisseur_id  ='" . $id . "'"]);
                // foreach ($lignecmd as $c) {
                //     $this->Commandefournisseurs->Lignecommandefournisseurs->delete($c);
                // }
                if (isset($this->request->getData('data')['ligner']) && (!empty($this->request->getData('data')['ligner']))) {
                    $this->loadModel('Commandefournisseurs');
                    foreach ($this->request->getData('data')['ligner'] as $i => $commande) {
                        if ($commande['sup0'] != 1) {
                            $data['commandefournisseur_id'] = $cmd_id;
                            $data['fournisseur_id'] = $this->request->getData('fournisseur_id');
                            $data['date'] = date('d-m-y');
                            $data['qte'] = $commande['qtecmd'];
                            $data['prix'] = $commande['prixcmd'];
                            $data['ht'] = $commande['punhtcmd'];
                            $data['article_id'] = $commande['article_id'];
                            $data['remise'] = $commande['remisecmd'];
                            $data['fodec'] = $commande['fodeccmd'];
                            $data['tva'] = $commande['tvacmd'];
                            $data['ttc'] = $commande['ttccmd'];
                            $cd = $this->fetchTable('Lignecommandefournisseurs')->newEmptyEntity();
                            $cd = $this->Lignecommandefournisseurs->patchEntity($cd, $data);
                            if ($this->Lignecommandefournisseurs->save($cd)) {
                            } else {
                            }
                            $this->set(compact("cd"));
                        }
                    }
                }

                return $this->redirect(['action' => 'vieww/', $project_id]);
            }
        }
        $demandeoffredeprixes = $this->Commandefournisseurs->Demandeoffredeprixes->find('list', ['limit' => 200]);
        $depots = $this->Commandefournisseurs->Depots->find('list', ['limit' => 200]);
        $cartecarburants = $this->Commandefournisseurs->Cartecarburants->find('list', ['limit' => 200]);
        $materieltransports = $this->Commandefournisseurs->Materieltransports->find('list', ['limit' => 200]);
        $articles = $this->Commandefournisseurs->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'nom']);
        $this->loadModel('Conteneurs');
        $conteneur = $this->fetchTable('Conteneurs')->find('list', ['keyfield' => 'id', 'valueField' => 'Identifiant']);
        $this->loadModel('Fournisseurs');
        $this->loadModel('Projets');
        $projets = $this->fetchTable('Projets')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        // $devises = $this->fetchTable('Devises')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $devises = $this->fetchTable('Devises')->find('list', [
            'keyfield' => 'id',
            'valueField' => function ($d) {
                return $d->name . ' (' . $d->symbole . ')';
            }
        ]);
        $incoterms = $this->fetchTable('Incoterms')->find('list', ['keyfield' => 'id', 'valueField' => 'code']);
        $fournisseurs = $this->fetchTable('Fournisseurs')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $projet_id = $project_id;

        $paiements = $this->Paiements->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $devises = $this->Devises->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $conditionreglements = $this->Conditionreglements->find('list', ['keyfield' => 'id', 'valueField' => 'conditionn']);
        $methodeexpeditions = $this->Methodeexpeditions->find('list', ['keyfield' => 'id', 'valueField' => 'methode']);
        $this->set(compact('paiements', 'devises', 'conditionreglements', 'methodeexpeditions', 'projet_id', 'project_id', 'devises', 'incoterms', 'conteneur', 'commande', 'projets', 'articles', 'demandeoffredeprixes', 'fournisseurs', 'depots', 'cartecarburants', 'materieltransports', 'type'));
    }
    public function addcmdftest($project_id = null)
    {
        if (isset($this->request->getData('data')['ligner']) && (isset($this->request->getData('data')['commandefournisseur']))) {
            $commande = $this->fetchTable('Commandefournisseurs')->newEmptyEntity();
            foreach ($this->request->getData('data')['commandefournisseur'] as $i => $cmdfourn) {
                $data['numero'] = $cmdfourn['numero'];
                $data['date'] = $cmdfourn['date'];
                $data['fournisseur_id'] = $cmdfourn['fournisseur_id'];
                $data['projet_id'] = $project_id;
                $data['tvaOnOff'] = $cmdfourn['tvaOnOff'];
                $data['depot_id'] = $cmdfourn['depot_id'];
                $data['conteneur_id'] = $cmdfourn['conteneur_id'];
                $data['typecommande'] = $typeof;
                $data['remise'] = $cmdfourn['remise'];
                $data['tva'] = $cmdfourn['tva'];
                $data['fodec'] = $cmdfourn['fodec'];
                $data['ht'] = $cmdfourn['ht'];
                $data['ttc'] = $cmdfourn['ttc'];
                $commande = $this->Commandefournisseurs->patchEntity($commande, $data);
                if ($this->Commandefournisseurs->save($commande)) {
                    // debug($commande);
                    $projet_id = $commande['projet_id'];
                    $this->loadModel('Projets');
                    $projet = $this->Projets->get($projet_id);
                    $datetimeActuelle = FrozenTime::now();
                    $datetimeActuelle->format('Y-m-d H:i:s');
                    $projet->datemodification = $datetimeActuelle;

                    // debug($projet->toArray());
                    // debug($client_idd);
                    $this->Projets->save($projet);
                    $cmd_id = ($this->Commandefournisseurs->save($commande)->id);
                    $this->misejour("Commandefournisseurs", "add", $cmd_id);
                    $commande_id = $commande->id;
                    if (isset($this->request->getData('data')['ligner']) && (!empty($this->request->getData('data')['ligner']))) {
                        $this->loadModel('Commandefournisseurs');
                        foreach ($this->request->getData('data')['ligner'] as $i => $commande) {
                            if ($commande['sup0'] != 1) {
                                $data['commandefournisseur_id'] = $commande_id;
                                $data['fournisseur_id'] = $this->request->getData('fournisseur_id');
                                $data['date'] = date('d-m-y');
                                $data['qte'] = $commande['qtecmd'];
                                $data['prix'] = $commande['prixcmd'];
                                // debug($commande['prixcmd']);die;
                                $data['ht'] = $commande['punhtcmd'];
                                $data['article_id'] = $commande['article_id'];
                                $data['remise'] = $commande['remisecmd'];
                                $data['fodec'] = $commande['fodeccmd'];
                                $data['tva'] = $commande['tvacmd'];
                                $data['ttc'] = $commande['ttccmd'];
                                $cd = $this->fetchTable('Lignecommandefournisseurs')->newEmptyEntity();
                                $cd = $this->Lignecommandefournisseurs->patchEntity($cd, $data);
                                if ($this->Lignecommandefournisseurs->save($cd)) {
                                    // debug($cd);
                                } else {
                                }
                                $this->set(compact("cd"));
                            }
                        }
                    }
                }
            }
        }
        //  $demandeoffredeprixes = $this->Commandefournisseurs->Demandeoffredeprixes->find('list', ['limit' => 200]);
        $depots = $this->fetchTable('Depots')->find('list', ['limit' => 200]);
        $cartecarburants = $this->fetchTable('Cartecarburants')->find('list', ['limit' => 200]);
        $materieltransports = $this->fetchTable('Materieltransports')->find('list', ['limit' => 200]);
        $articles = $this->fetchTable('Articles')->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation']);
        $this->loadModel('Conteneurs');
        $conteneur = $this->fetchTable('Conteneurs')->find('list', ['keyfield' => 'id', 'valueField' => 'Identifiant']);
        $this->loadModel('Fournisseurs');
        $this->loadModel('Projets');
        $projets = $this->fetchTable('Projets')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $fournisseurs = $this->fetchTable('Fournisseurs')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $devises = $this->fetchTable('Devises')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $incoterms = $this->fetchTable('Incoterms')->find('list', ['keyfield' => 'id', 'valueField' => 'code']);
        $this->set(compact('project_id', 'devises', 'incoterms', 'conteneur', 'commande', 'projets', 'articles', 'demandeoffredeprixes', 'fournisseurs', 'depots', 'cartecarburants', 'materieltransports', 'type'));
    }
    public function deletecomfour($id = null, $project_id = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_achat' . $abrv);
        $cmd = 0;
        foreach ($liendd as $k => $liens) {
            if (@$liens['lien'] == 'commandes') {
                $cmd = $liens['supp'];
            }
        }
        if (($cmd <> 1)) {
            $this->redirect(array('controller' => 'Users', 'action' => 'login'));
        }
        $this->loadModel('Commandefournisseurs');
        $this->loadModel('Lignecommandefournisseurs');
        $this->request->allowMethod(['post', 'delete']);
        $ff = $this->fetchTable('Fournisseurpaiementcommandes')->find('all')->where(['Fournisseurpaiementcommandes.commandefournisseur_id=' . $id]);
        foreach ($ff as $f) {
            $this->fetchTable('Fournisseurpaiementcommandes')->delete($f);
        }
        $commande = $this->Commandefournisseurs->get($id);
        $lignecommande = $this->Lignecommandefournisseurs->find('all')
            ->where(["Lignecommandefournisseurs.commandefournisseur_id  ='" . $id . "'"]);
        foreach ($lignecommande as $c) {
            $this->Commandefournisseurs->Lignecommandefournisseurs->delete($c);
        }
        if (isset($commande['demandeoffredeprix_id'])) {
            $this->loadModel('Demandeoffredeprixes');
            $demande = $this->Demandeoffredeprixes->find('all', [])
                ->where(["Demandeoffredeprixes.id  ='" . $commande['demandeoffredeprix_id'] . "'"]);
            foreach ($demande as $d)
                $d->commande = '0';
            $this->Demandeoffredeprixes->save($d);
        } else {
        }
        if ($this->Commandefournisseurs->delete($commande)) {
            $cmd_id = ($this->Commandefournisseurs->save($commande)->id);
            $this->misejour("Commandefournisseurs", "delete", $cmd_id);
            $projet_id = $cmd_id['projet_id'];
            $this->loadModel('Projets');
            $projet = $this->Projets->get($project_id);
            $datetimeActuelle = FrozenTime::now();
            $datetimeActuelle->format('Y-m-d H:i:s');
            $projet->datemodification = $datetimeActuelle;
            $this->Projets->save($projet);
            return $this->redirect(['action' => 'vieww/', $project_id]);
        }
    }
    public function viewcomfour($id = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_achat' . $abrv);
        $cmd = 0;
        foreach ($liendd as $k => $liens) {
            if (@$liens['lien'] == 'commandes') {
                $cmd = $liens['modif'];
            }
        }
        if (($cmd <> 1)) {
            $this->redirect(array('controller' => 'Users', 'action' => 'login'));
        }
        $this->loadModel('Commandefournisseurs');
        $this->loadModel('Lignecommandefournisseurs');
        $this->loadModel('Paiements');
        $this->loadModel('Devises');
        $this->loadModel('Conditionreglements');
        $this->loadModel('Methodeexpeditions');
        $this->loadModel('Demandeoffredeprixes');
        $commande = $this->Commandefournisseurs->get($id, [
            'contain' => []
        ]);
        $this->loadModel('Commandefournisseurs');
        $project_id = $commande->projet_id;
        $type = $commande->typecommande;

        $lignecommandes = $this->Commandefournisseurs->Lignecommandefournisseurs->find('all', [
            'contain' => ['Articles']
        ])
            ->where(['commandefournisseur_id' => $id]);
        $demandeoffredeprixes = $this->Commandefournisseurs->Demandeoffredeprixes->find('list', ['limit' => 200]);
        $depots = $this->Commandefournisseurs->Depots->find('list', ['limit' => 200]);
        $cartecarburants = $this->Commandefournisseurs->Cartecarburants->find('list', ['limit' => 200]);
        $materieltransports = $this->Commandefournisseurs->Materieltransports->find('list', ['limit' => 200]);
        $articles = $this->Commandefournisseurs->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'nom']);
        $this->loadModel('Conteneurs');
        $conteneur = $this->fetchTable('Conteneurs')->find('list', ['keyfield' => 'id', 'valueField' => 'Identifiant']);
        $this->loadModel('Fournisseurs');
        $this->loadModel('Projets');
        $projets = $this->fetchTable('Projets')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $fournisseurs = $this->fetchTable('Fournisseurs')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        // $devises = $this->fetchTable('Devises')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $devises = $this->fetchTable('Devises')->find('list', [
            'keyfield' => 'id',
            'valueField' => function ($d) {
                return $d->name . ' (' . $d->symbole . ')';
            }
        ]);
        $incoterms = $this->fetchTable('Incoterms')->find('list', ['keyfield' => 'id', 'valueField' => 'code']);
        $paiements = $this->Paiements->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $devises = $this->Devises->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $conditionreglements = $this->Conditionreglements->find('list', ['keyfield' => 'id', 'valueField' => 'conditionn']);
        $methodeexpeditions = $this->Methodeexpeditions->find('list', ['keyfield' => 'id', 'valueField' => 'methode']);
        $this->set(compact('paiements', 'devises', 'conditionreglements', 'methodeexpeditions', 'project_id', 'devises', 'incoterms', 'conteneur', 'commande', 'lignecommandes', 'projets', 'articles', 'demandeoffredeprixes', 'fournisseurs', 'depots', 'cartecarburants', 'materieltransports', 'type'));
    }
    public function deletedof($id = null)
    {
        // dd($id);
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_achat' . $abrv);
        $dmd = 0;
        foreach ($liendd as $k => $liens) {
            if (@$liens['lien'] == 'demandeoffredeprixes') {
                $dmd = $liens['supp'];
            }
        }
        if (($dmd <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $this->loadModel('Demandeoffredeprixes');
        $this->loadModel('Lignedemandeoffredeprixes');
        $demande = $this->Demandeoffredeprixes->get($id);
        $project_id = $demande['projet_id'];
        $lignedemande = $this->Lignedemandeoffredeprixes->find('all')
            ->where(["Lignedemandeoffredeprixes.demandeoffredeprix_id  ='" . $id . "'"]);
        foreach ($lignedemande as $c) {
            $this->Demandeoffredeprixes->Lignedemandeoffredeprixes->delete($c);
        }
        if ($this->Demandeoffredeprixes->delete($demande)) {
            $dmd_id = ($this->Demandeoffredeprixes->save($demande)->id);
            $projet_id = $dmd_id['projet_id'];
            $this->loadModel('Projets');
            $projet = $this->Projets->get($project_id);
            $datetimeActuelle = FrozenTime::now();
            $datetimeActuelle->format('Y-m-d H:i:s');
            $projet->datemodification = $datetimeActuelle;
            $this->Projets->save($projet);
            $this->misejour("Demandeoffredeprixes", "delete", $dmd_id);
        }
        return $this->redirect(['action' => 'vieww/', $project_id]);
    }
    public function viewdof($id = null)
    {
        $this->loadModel('Demandeoffredeprixes');
        $this->loadModel('Fournisseurs');
        $this->loadModel('Articles');
        $this->loadModel('Lignedemandeoffredeprixes');
        $demandeoffredeprix = $this->Demandeoffredeprixes->get($id, [
            'contain' => ['Bandeconsultations', 'Lignebandeconsultations', 'Lignedemandeoffredeprixes', 'Lignelignebandeconsultations'],
        ]);
        $project_id = $demandeoffredeprix['projet_id'];

        $ligneas = $this->Lignedemandeoffredeprixes->find('all', ['keyfield' => 'id', 'valueField' => 'designiationA'])
            ->group(["nomar" => '(Lignedemandeoffredeprixes.designiationA)'])
            ->where(["Lignedemandeoffredeprixes.demandeoffredeprix_id ='" . $id . "'"]);
        $lignefs = $this->Lignedemandeoffredeprixes->find('all', ['keyfield' => 'id', 'valueField' => 'nameF'])
            ->group(["nomfour" => '(Lignedemandeoffredeprixes.nameF)'])
            ->where(["Lignedemandeoffredeprixes.demandeoffredeprix_id  ='" . $id . "'"]);
        $this->loadModel('Projets');
        $fournisseurs = $this->Demandeoffredeprixes->Fournisseurs->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $projets = $this->fetchTable('Projets')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $this->set(compact('project_id', 'lignefs', 'ligneas', 'demandeoffredeprix', 'projets', 'fournisseurs'));
    }
    public function editdof($id = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_achat' . $abrv);
        $dmd = 0;
        foreach ($liendd as $k => $liens) {
            if (@$liens['lien'] == 'demandeoffredeprixes') {
                $dmd = $liens['modif'];
            }
        }
        if (($dmd <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $this->loadModel('Demandeoffredeprixes');
        $this->loadModel('Fournisseurs');
        $this->loadModel('Lignedemandeoffredeprixes');
        $this->loadModel('Articles');
        $demandeoffredeprix = $this->Demandeoffredeprixes->get($id, [
            'contain' => ['Lignedemandeoffredeprixes']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $num = $this->Demandeoffredeprixes->find()->select([
                "numdepot" =>
                'MAX(Demandeoffredeprixes.numero)'
            ])->first();
            $numero = $num->numdepot;
            $n = 0;
            $n = $numero;
            if (!empty($n)) {
                $ff = intval(substr($n, 3, 7)) + 1;
                $z = str_pad("$ff", 5, '0', STR_PAD_LEFT);
                $c = str_pad("$z", 6, 'F', STR_PAD_LEFT);
                $code = str_pad("$c", 7, 'O', STR_PAD_LEFT);
                $b = str_pad("$code", 8, 'D', STR_PAD_LEFT);
            } else {
                $n = "00001";
                $c = str_pad("$n", 6, 'F', STR_PAD_LEFT);
                $code = str_pad("$c", 7, 'O', STR_PAD_LEFT);
                $b = str_pad("$code", 8, 'D', STR_PAD_LEFT);
            }
            $this->set(compact('b'));
            $demandeoffredeprix = $this->Demandeoffredeprixes->patchEntity($demandeoffredeprix, $this->request->getData());
            if ($this->Demandeoffredeprixes->save($demandeoffredeprix)) {
                $dmd_id = ($this->Demandeoffredeprixes->save($demandeoffredeprix)->id);
                $this->misejour("Demandeoffredeprixes", "edit", $dmd_id);
                $projet_id = $dmd_id['projet_id'];
                $this->loadModel('Projets');
                $projet = 91;
                //die;
                // $projet->datemodification =$datetimeActuelle;
                //  debug($projet);die;
                //   $this->Projets->save($projet);
                $demande_id = $demandeoffredeprix->id;
                $lignedemande = $this->Lignedemandeoffredeprixes->find('all', [])
                    ->where(["Lignedemandeoffredeprixes.demandeoffredeprix_id ='" . $id . "'"]);
                foreach ($lignedemande as $c) {
                    $this->Demandeoffredeprixes->Lignedemandeoffredeprixes->delete($c);
                }
                if (isset($this->request->getData('data')['lignef']) && (!empty($this->request->getData('data')['lignef']))) {
                    foreach ($this->request->getData('data')['lignef'] as $j => $fourni) {
                        if ($fourni['sup1'] != 1) {
                            if ($fourni['fournisseur_id']) {
                                $fr = $this->Fournisseurs->find()->select(["nomfour" => '(Fournisseurs.name)'])->where(["Fournisseurs.id" => $fourni['fournisseur_id']])->first();
                                $frr = $fr->nomfour;
                                $fourni['nameF'] = $frr;
                            } else {
                                $fourni['nameF'] = $fourni['nameF'];
                            }
                            if (isset($this->request->getData('data')['lignea']) && (!empty($this->request->getData('data')['lignea']))) {
                                $this->loadModel('Articles');
                                foreach ($this->request->getData('data')['lignea'] as $i => $art) {
                                    if ($art['sup0'] != 1) {
                                        if ($art['article_id']) {
                                            $ar = $this->Articles->find()->select(["nomarticle" => '(Articles.Dsignation)'])->where(["Articles.id" => $art['article_id']])->first();
                                            $arr = $ar->nomarticle;
                                            $art['designiationA'] = $arr;
                                        } else {
                                            $art['designiationA'] = $art['designiationA'];
                                        }
                                        $data['demandeoffredeprix_id'] = $id;
                                        $data['article_id'] = $art['article_id'];
                                        $data['designiationA'] = $art['designiationA'];
                                        $data['qte'] = $art['qte'];
                                        $data['fournisseur_id'] = $fourni['fournisseur_id'];
                                        $data['nameF'] = $fourni['nameF'];
                                        $data['mail'] = $fourni['mail'];
                                        $demandeoffre = $this->fetchTable('Lignedemandeoffredeprixes')->newEmptyEntity();
                                        $demandeoffre = $this->Lignedemandeoffredeprixes->patchEntity($demandeoffre, $data);

                                        if ($this->Lignedemandeoffredeprixes->save($demandeoffre)) {
                                        }
                                        $this->set(compact("demandeoffre"));
                                    }
                                }
                            }
                        }
                    }
                    return $this->redirect(['action' => 'vieww/' . $demandeoffredeprix['projet_id']]);
                }
                return $this->redirect(['action' => 'vieww/' . $demandeoffredeprix['projet_id']]);
            }
        }
        $project_id = $demandeoffredeprix['projet_id'];
        $articles = $this->Demandeoffredeprixes->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation']);
        $fournisseurs = $this->Demandeoffredeprixes->Fournisseurs->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $lignes = $this->Lignedemandeoffredeprixes->find('all')
            ->where(["Lignedemandeoffredeprixes.demandeoffredeprix_id  ='" . $id . "'"])->toArray();
        debug($lignes);
        $lignefs = $this->Lignedemandeoffredeprixes->find('all', ['keyfield' => 'id', 'valueField' => 'nameF'])
            ->group(["nomfour" => '(Lignedemandeoffredeprixes.nameF)'])
            ->where(["Lignedemandeoffredeprixes.demandeoffredeprix_id  ='" . $id . "'"])->toArray();
        debug($lignefs);
        $ligneas = $this->Lignedemandeoffredeprixes->find('all', ['keyfield' => 'id', 'valueField' => 'designiationA'])
            ->group(["nomar" => '(Lignedemandeoffredeprixes.designiationA)'])
            ->where(["Lignedemandeoffredeprixes.demandeoffredeprix_id ='" . $id . "'"])->toArray();
        debug($ligneas);
        $this->loadModel('Projets');
        $projets = $this->fetchTable('Projets')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $this->set(compact('project_id', 'ligneas', 'lignefs', 'projets', 'demandeoffredeprix', 'articles', 'fournisseurs'));
    }
    public function addindccfc(array $tab = null, $project_id)
    {
        // debug($tab);
        $this->LoadModel('Factureclients');
        $num = $this->Factureclients->find()->select(["num" => 'MAX(Factureclients.numero)'])->first();
        $n = $num->num;
        $in = intval($n) + 1;
        $mm = str_pad("$in", 6, "0", STR_PAD_LEFT);
        $factureclient = $this->Factureclients->newEmptyEntity();
        if ($this->request->is('post')) {
            ///  Configure::write('debug', true);
            $num = $this->Factureclients->find()->select([
                "num" =>
                'MAX(Factureclients.numero)'
            ])->first();
            $n = $num->num;
            $in = intval($n) + 1;
            $mm = str_pad("$in", 6, "0", STR_PAD_LEFT);
            $data['numero'] = $this->request->getData('numero');
            $data['date'] = $this->request->getData('date');
            $data['client_id'] = $this->request->getData('client_id');
            $data['projet_id'] = $this->request->getData('projet_id');
            $data['depot_id'] = $this->request->getData('depot_id');
            $data['totalht'] = $this->request->getData('totalht');
            $data['totaltva'] = $this->request->getData('totaltva');
            $data['totalfodec'] = $this->request->getData('totalfodec');
            $data['totalremise'] = $this->request->getData('totalremise');
            $data['totalttc'] = $this->request->getData('totalttc');
            $data['totalmarge'] = $this->request->getData('totalmarge');
            $data['remisetotal'] = $this->request->getData('remisetotal');
            $data['totalmarque '] = $this->request->getData('totalmarque ');
            $data['remisetotalval'] = $this->request->getData('remisetotalval');
            $data['tvaOnOff'] = $this->request->getData('tvaOnOff');

            $data['commandeclient_id'] = $tab[0];
            $data['incoterm_id'] = $this->request->getData('incoterm_id');
            $data['location_incoterms'] = $this->request->getData('location_incoterms');
            $data['options_incotermtotalpdf'] = $this->request->getData('options_incotermtotalpdf');
            $data['options_istotaltransportdetaille'] = $this->request->getData('options_istotaltransportdetaille');
            $data['options_indicationenpdf'] = $this->request->getData('options_indicationenpdf');
            $data['devise_id'] = $this->request->getData('devis_id');
            $data['taux'] = $this->request->getData('taux');
            $data['nbfergule'] = $this->request->getData('nbfergule');
            $factureclient = $this->Factureclients->patchEntity($factureclient, $data);

            if ($this->Factureclients->save($factureclient)) {
                // $this->misejour("Factureclients", "add Indi", $tab);
                $this->misejour("Factureclients", "add", $tab);
                $projet_id = $factureclient['projet_id'];
                $this->misejour("Factureclients", "addprojet", $projet_id);
                $this->loadModel('Projets');
                $projet = $this->Projets->get($projet_id);
                $datetimeActuelle = FrozenTime::now();
                $datetimeActuelle->format('Y-m-d H:i:s');
                $projet->datemodification = $datetimeActuelle;
                $this->Projets->save($projet);
                $bonliv = $this->fetchTable('Commandeclients')->find()->where("Commandeclients.id IN (" . implode(', ', $tab) . ")")->first();
                $factureclient_id = $factureclient->id;
                $bonliv->facture_id = $factureclient_id;
                $this->fetchTable('Commandeclients')->save($bonliv);
                if (isset($this->request->getData('data')['ligner']) && (!empty($this->request->getData('data')['ligner']))) {
                    foreach ($this->request->getData('data')['ligner'] as $i => $l) {
                        $tab = $this->fetchTable('Lignefactureclients')->newEmptyEntity();
                        $tab['factureclient_id'] = $factureclient_id;
                        $tab['article_id'] = $l['article_id'];
                        $tab['qte'] = $l['qte'];
                        $tab['prixht'] = $l['prixht'];
                        $tab['ttc'] = $l['ttc'];
                        $tab['fodec'] = $l['fodec'];
                        $tab['tva'] = $l['tva'];
                        $tab['punht'] = $l['punht'];
                        $tab['remise'] = $l['remise'];
                        $tab['fournisseur_id'] = $l['fournisseur_id'];
                        $tab['type'] = $l['type'];
                        $tab['description'] = $l['description'];
                        $tab['unite_id'] = $l['unite_id'];
                        $tab['tauxdemarque'] = $l['tauxdemarque'];
                        $tab['tauxdemarge'] = $l['tauxdemarge'];

                        $this->fetchTable('Lignefactureclients')->save($tab);
                        //debug($tab);//die;
                    }
                }
                return $this->redirect(['action' => 'vieww/', $project_id]);
            }
        }
        $this->loadModel('Promoarticles');
        $this->loadModel('Gspromoarticles');
        $this->loadModel('Projets');
        $this->loadModel('Personnels');
        $this->loadModel('Commandeclients');
        $this->loadModel('Lignecommandeclients');
        $this->loadModel('Fournisseurs');

        $incoterms = $this->fetchTable('Incoterms')->find('list', ['keyfield' => 'id', 'valueField' => 'code']);
        $commandeclient = $this->Commandeclients->find('all', [
            'contain' => ['Conditionreglements', 'Delailivraisons', 'Methodeexpeditions', 'Lignecommandeclients', 'Clients', 'Projets', 'Incoterms', 'Devises'],
        ])
            ->where("Commandeclients.id  IN (" . implode(', ', $tab) . ") ")->first();
        $lignebonlivraisons = $this->Lignecommandeclients->find('all', ['contain' => ['Articles']])
            ->where("Lignecommandeclients.type=1 and Lignecommandeclients.commandeclient_id IN (" . implode(', ', $tab) . ") ");
        //debug($lignebonlivraisons->toArray());die;
        $lignebonlivraison2s = $this->Lignecommandeclients->find('all', ['contain' => ['Articles']])
            ->where("Lignecommandeclients.type=2 and Lignecommandeclients.commandeclient_id IN (" . implode(', ', $tab) . ") ");
        $chauffeurs = $this->Personnels->find('all')->where(["Personnels.fonction_id like  '%" . 5 . "%' "]);
        $conffaieurs = $this->Personnels->find('all')->where(["Personnels.fonction_id like  '%" . 1 . "%' "]);
        $clients = $this->fetchTable('Commandes')->Clients->find('all');
        $pointdeventes = $this->Factureclients->Pointdeventes->find('list', ['limit' => 200]);
        $depots = $this->Factureclients->Depots->find('list', ['limit' => 200]);
        $materieltransports = $this->Factureclients->Materieltransports->find('list', ['keyfield' => 'id', 'valueField' => 'matricule']);
        $cartecarburants = $this->Factureclients->Cartecarburants->find('list', ['limit' => 200]);
        $bonlivraison = $this->fetchTable('Commandeclients')->find()->where("Commandeclients.id IN (" . implode(', ', $tab) . ")")->contain('Lignecommandeclients', 'Clients');
        $bonlivraisonclients = $this->fetchTable('Commandeclients')->find()->where("Commandeclients.id IN (" . implode(', ', $tab) . ")")->contain('Lignecommandeclients', 'Clients')->first();
        $client_id = $bonlivraisonclients->client_id;
        $depot_id = $bonlivraisonclients->depot_id;
        $projet_id = $bonlivraisonclients->projet_id;
        $clientc = $this->fetchTable('Clients')->get($client_id);
        if ($typecl = 'false') {
            $cl = 'false';
        } else {
            $cl = 'true';
        }
        $escom = $clientc->typeescompte;
        if ($escom == TRUE) {
            $es = 'avec palier';
        }
        if ($escom == FALSE) {
            $es = 'sans palier';
        }
        $esremise = $clientc->typeremise;
        if ($esremise == TRUE) {
            $rz = 'avec palier';
        }
        if ($esremise == FALSE) {
            $rz = 'sans palier';
        }
        $tim = $this->fetchTable('Timbres')->find()->select([
            "timbre" =>
            'MAX(Timbres.timbre)'
        ])->first();
        $timbre = $tim->timbre;
        $cond1 = "Clientexonerations.date_debut <= '" . $m . "' ";
        $cond2 = "Clientexonerations.date_fin >= '" . $m . "' ";
        $cond3 = "Clientexonerations.client_id = '" . $bonlivraison->client_id . "' ";
        $exo = $this->fetchTable('Clientexonerations')->find('all', [
            'contain' => ['Typeexons']
        ])->where([$cond3, $cond1, $cond2]);
        $BL = $clientc->bl;
        $date = $bonlivraison->date;

        $cond1 = "Promoarticles.datedebut <= '" . $date . "'";
        $cond2 = "Promoarticles.datefin >='" . $date . "'";
        $cond4 = "Gspromoarticles.datedebut <= '" . $date . "'";
        $cond5 = "Gspromoarticles.datefin >='" . $date . "'";
        $adresselivraisonclients = $this->fetchTable('Adresselivraisonclients')->find('list', ['keyfield' => 'id', 'valueField' => 'adresse']);
        $articles = $this->fetchTable('Articles')->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(['Articles.typearticle=1']);
        $articleservises = $this->fetchTable('Articles')->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(['Articles.typearticle=2']);

        $projets = $this->fetchTable('Projets')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $fournisseurs = $this->Fournisseurs->find('list');
        $unites = $this->fetchTable('Unites')->find('list');
        $parametretaus = $this->fetchTable('Parametretaus')->find('all')->first();

        $typeremises['1'] = "%";
        $typeremises['2'] = "Valeur";
        $devises = $this->fetchTable('Devises')->find('list', [
            'keyfield' => 'id',
            'valueField' => function ($d) {
                return $d->name . ' (' . $d->symbole . ')';
            }
        ]);
        $this->set(compact('unites', 'commandeclient', 'devises', 'typeremises', 'parametretaus', 'articleservises', 'fournisseurs', 'lignebonlivraison2s', 'project_id', 'BL', 'clientc', 'projet_id', 'incoterms', 'client_id', 'depot_id', 'projets', 'timbre', 'bonlivraison', 'lignebonlivraisons', 'mm', 'articles', 'factureclient', 'clients', 'pointdeventes', 'depots', 'materieltransports', 'cartecarburants', 'chauffeurs', 'conffaieurs', 'adresselivraisonclients', 'cl', 'rz', 'es'));
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function devalidation($id, $project_id = null)
    {
        $project_id = $this->request->getQuery('project_id');
        $this->loadModel('Commandeclients');
        $commande = $this->Commandeclients->get($id, [
            'contain' => ['Clients']
        ]);
        $commande->valider = 1;
        if ($this->Commandeclients->save($commande)) {

            $this->misejour("Offre ggb", "Validation", $id);
            $projet_id = $commande['projet_id'];
            $this->loadModel('Projets');
            $projet = $this->Projets->get($projet_id);
            $datetimeActuelle = FrozenTime::now();
            $datetimeActuelle->format('Y-m-d H:i:s');
            $projet->datemodification = $datetimeActuelle;
            $this->Projets->save($projet);
            return $this->redirect(['action' => 'vieww/' . $project_id]);
        }
        die;
    }
    public function validationcommande($id)
    {
        // debug($id);
        $project_id = $this->request->getQuery('project_id');
        $this->loadModel('Commandefournisseurs');
        $commandefour = $this->Commandefournisseurs->find('all')->where('Commandefournisseurs.demandeoffredeprix_id=' . $id)->first();
        debug($commandefour);
        $commandefour->valide = 1;
        if ($this->Commandefournisseurs->save($commandefour)) {
            $this->misejour("Commande Fournisseurs", "Validation", $id);
            $projet_id = $commandefour['projet_id'];
            $this->loadModel('Projets');
            $projet = $this->Projets->get($projet_id);
            $datetimeActuelle = FrozenTime::now();
            $datetimeActuelle->format('Y-m-d H:i:s');
            $projet->datemodification = $datetimeActuelle;
            $this->Projets->save($projet);
            return $this->redirect(['action' => 'vieww/' . $project_id]);
        }
        die;
    }
    public function addindcfff($tab = null, $project_id = null)
    {
        $this->loadModel('Commandefournisseurs');
        $this->loadModel('Factures');
        $livraison = $this->fetchTable('Commandefournisseurs')->get($tab);
        $this->loadModel('Lignecommandefournisseurs');
        $lignelivraisons = $this->Lignecommandefournisseurs->find('all', [
            'contain' => ['Articles']
        ])
            ->where(['commandefournisseur_id' => $tab]);
        $facture = $this->Factures->newEmptyEntity();
        $last = $this->Factures->find()->order(['id' => "desc"])->first();
        $numero = 1;
        if ($last != null) {
            preg_match_all('!\d+!', $last->numero, $numero);
            $numero = $numero[0][0];
        }
        $facture = $this->Factures->newEmptyEntity();
        if ($this->request->is('post')) {
            $data['numero'] = $this->request->getData('numero');
            $data['date'] = $this->request->getData('date');
            $data['fournisseur_id'] = $this->request->getData('fournisseur_id');
            $data['adresselivraisonfournisseur_id'] = $this->request->getData('adresselivraisonfournisseur_id');
            $data['depot_id'] = $this->request->getData('depot_id');
            $data['conteneur_id'] = $this->request->getData('conteneur_id');
            $data['projet_id'] = $this->request->getData('projet_id');
            $data['tvaOnOff'] = $this->request->getData('tvaOnOff');
            $data['ht'] = $this->request->getData('ht');
            $data['tva'] = $this->request->getData('tva');
            $data['fodec'] = $this->request->getData('fodec');
            $data['remise'] = $this->request->getData('remise');
            $data['ttc'] = $this->request->getData('ttc');
            $data['incoterm_id'] = $this->request->getData('incoterm_id');
            $data['location_incoterms'] = $this->request->getData('location_incoterms');
            $data['options_incotermtotalpdf'] = $this->request->getData('options_incotermtotalpdf');
            $data['options_istotaltransportdetaille'] = $this->request->getData('options_istotaltransportdetaille');
            $data['options_indicationenpdf'] = $this->request->getData('options_indicationenpdf');
            $data['devise_id'] = $livraison->devise_id;

            // $data['valide'] = 1;
            $facture = $this->Factures->patchEntity($facture, $data);
            if ($this->Factures->save($facture)) {
                // debug($facture);die;
                $facture_id = $facture->id;
                $this->misejour("Facture Fournisseurs", "Add", $facture_id);
                // $this->misejour("Facture Fournisseurs", "Add indirecte", $tab);
                $projet_id = $facture['projet_id'];
                $this->misejour("Facture Fournisseurs", "addprojet", $projet_id);
                // $this->misejour("Facture Fournisseurs", "Add indirecte", $projet_id);
                $this->loadModel('Projets');
                $projet = $this->Projets->get($projet_id);
                $datetimeActuelle = FrozenTime::now();
                $datetimeActuelle->format('Y-m-d H:i:s');
                $projet->datemodification = $datetimeActuelle;
                $this->Projets->save($projet);
                $d = $this->fetchTable('Commandefournisseurs')->get($tab, [
                    'contain' => ['Projets']
                ]);
                $d['facture_id'] = $facture_id;
                $d['valide'] = 1;
                $this->fetchTable('Commandefournisseurs')->save($d);
                // debug($d);
                if (isset($this->request->getData('data')['ligner']) && (!empty($this->request->getData('data')['ligner']))) {
                    foreach ($this->request->getData('data')['ligner'] as $i => $l) {
                        $tab = $this->fetchTable('Lignefactures')->newEmptyEntity();
                        $tab['facture_id'] = $facture_id;
                        $tab['article_id'] = $l['article_id'];
                        $tab['qte'] = $l['qte'];
                        $tab['ttc'] = $l['ttc'];
                        $tab['fodec'] = $l['fodec'];
                        $tab['tva'] = $l['tva'];
                        $tab['ht'] = $l['punht'];
                        $tab['remise'] = $l['remise'];
                        $tab['prix'] = $l['prix'];
                        $this->fetchTable('Lignefactures')->save($tab);
                    }
                }
                return $this->redirect(['action' => 'vieww/' . $project_id]);
            }
        }
        $this->loadModel('Personnels');
        $this->loadModel('Pointdeventes');
        $this->loadModel('Depots');
        $this->loadModel('Projets');
        $this->fetchTable('Projets');
        $this->loadModel('Materieltransports');
        $this->loadModel('Cartecarburants');
        $this->loadModel('Adresselivraisonfournisseurs');
        $this->loadModel('Articles');
        $this->loadModel('Personnels');
        $this->loadModel('Timbres');
        $this->loadModel('Conteneurs');
        $fournisseurs = $this->fetchTable('Commandefournisseurs')->Fournisseurs->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $depots = $this->Depots->find('list', ['limit' => 200]);
        $projets = $this->Projets->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $materieltransports = $this->Materieltransports->find('list', ['keyfield' => 'id', 'valueField' => 'matricule']);
        $cartecarburants = $this->Cartecarburants->find('list', ['limit' => 200]);
        $adresselivraisonfournisseurs = $this->Adresselivraisonfournisseurs->find('list', ['keyfield' => 'id', 'valueField' => 'adresse']);
        $articles = $this->Articles->find('all');
        $chauffeurs = $this->Personnels->find('all')->where(["Personnels.fonction_id  ='" . 5 . "%' "]);
        $conffaieurs = $this->Personnels->find('all')->where(["Personnels.fonction_id ='" . 1 . "%' "]);
        $timbr = $this->Timbres->find('all', ['keyfield' => 'id', 'valueField' => 'timbre']);
        $incoterms = $this->fetchTable('Incoterms')->find('list', ['keyfield' => 'id', 'valueField' => 'code']);
        $tab1 = array();
        $conteneur = $this->fetchTable('Conteneurs')->find('list', ['keyfield' => 'id', 'valueField' => 'Identifiant']);
        foreach ($timbr as $tab1); {
        }
        $this->set(compact('project_id', 'conteneur', 'incoterms', 'lignelivraisons', 'projets', 'tab1', 'timbr', 'livraison', 'numero', 'articles', 'facture', 'fournisseurs', 'pointdeventes', 'depots', 'materieltransports', 'cartecarburants', 'chauffeurs', 'conffaieurs', 'adresselivraisonfournisseurs'));
    }
    public function reglementfournisseur($id = null, $project_id = null)
    {
        $s = $id;
        $this->loadModel('Factures');
        $this->loadModel('Livraisons');
        $this->loadModel('Reglements');
        $this->loadModel('Lignereglements');
        $this->loadModel('Banques');
        $this->loadModel('Piecereglements');

        $reglement = $this->Reglements->get($id, ['contain' => ['Fournisseurs', 'Importations', 'Utilisateurs', 'Exercices', 'Devises', 'Lignereglements', 'Piecereglements'],]);
        $four = $reglement->fournisseur_id;
        $lignesreg = $this->Lignereglements->find('all')->where(['Lignereglements.reglement_id =' . $id]);
        $piecereglements = $this->Piecereglements->find('all')->where(['Piecereglements.reglement_id =' . $id])->contain(['Paiements', 'Banques']);
        $mtbon = 0.000;
        $mtfact = 0.000;
        foreach ($lignesreg as $k => $ligne) {
            if ($ligne['facture_id'] != null) {
                $facreg[$ligne['facture_id']] = 1;
                $mtfact = $mtfact + $ligne['Montant'];
            } else {
                $facreg[$ligne['livraison_id']] = 1;
                $mtbon = $mtbon + $ligne['Montant'];
            }
        }
        if ($four != null) {
            $this->loadModel('Factures');
            $this->loadModel('Livraisons');
            $factures = $this->Factures->find('all')->where(['Factures.fournisseur_id =' . $four]);
        }
        $this->loadModel('Tos');
        $valeurs = $this->Tos->find('list', ['limit' => 200])->all();
        $this->loadModel('Paiements');
        $paiements = $this->Paiements->find('list', ['limit' => 200])->all();
        $this->loadModel('Carnetcheques');
        $carnetcheques = $this->Carnetcheques->find('list', ['limit' => 200])->all();
        $pointdeventes = $this->Reglements->Pointdeventes->find('list', ['limit' => 200])->all();
        $fournisseurs = $this->Reglements->Fournisseurs->find('list', ['limit' => 200])->all();
        $fournisseurs = $this->Reglements->Fournisseurs->find('list', ['limit' => 200])->all();
        $importations = $this->Reglements->Importations->find('list', ['limit' => 200])->all();
        $utilisateurs = $this->Reglements->Utilisateurs->find('list', ['limit' => 200])->all();
        $exercices = $this->Reglements->Exercices->find('list', ['limit' => 200])->all();
        $devises = $this->Reglements->Devises->find('list', ['limit' => 200])->all();
        $banques = $this->fetchTable('Banques')->find('list', ['keyField' => 'id', 'valueField' => 'name']);
        $comptes = $this->fetchTable('ComptesBank')->find('list', ['keyField' => 'id', 'valueField' => 'compte']);
        $this->set(compact('project_id', 'banques', 'comptes', 'mtfact', 'mtbon', 'facreg', 'piecereglements', 's', 'lignesreg', 'pointdeventes', 'valeurs', 'carnetcheques', 'paiements', 'p', 'four', 'livraisons', 'factures', 'reglement', 'fournisseurs', 'importations', 'utilisateurs', 'exercices', 'devises'));
    }
    public function reglementclient($id = null, $project_id = null)
    {
        $this->loadModel('Factureclients');
        $this->loadModel('Bonlivraisons');
        $this->loadModel('Lignereglementclients');
        $this->loadModel('Piecereglementclients');
        $this->loadModel('Reglementclients');
        $this->loadModel('Factureclients');
        $this->loadModel('Commandeclients');
        $reglement = $this->Reglementclients->get($id, [
            'contain' => [],
        ]);
        $cli = $reglement->client_id;
        $lignesreg = $this->Lignereglementclients->find('all')->where(['Lignereglementclients.reglementclient_id =' . $id]);
        $piecereglementclients = $this->Piecereglementclients->find('all')->where(['Piecereglementclients.reglementclient_id =' . $id])->contain(['Paiements', 'Banques']);
        $mtbon = 0.000;
        $mtfact = 0.000;
        foreach ($lignesreg as $k => $ligne) {
            if ($ligne['factureclient_id'] != null) {
                $facreg[$ligne['factureclient_id']] = 1;
                $mtfact = $mtfact + $ligne['Montant'];
            } else {
                $facreg[$ligne['bonlivraison_id']] = 1;
                $mtbon = $mtbon + $ligne['Montant'];
            }
        }
        if ($cli != null) {
            $factures = $this->Factureclients->find('all')->where(['Factureclients.projet_id =' . $project_id, 'Factureclients.totalttc > Factureclients.Montant_Regler']);
            $livraisons = $this->Commandeclients->find('all')->where(['Commandeclients.client_id =' . $cli]);
        }
        $this->loadModel('Paiements');
        $this->loadModel('Carnetcheques');
        $this->loadModel('Tos');
        $valeurs = $this->Tos->find('list', ['limit' => 200])->all();
        $paiements = $this->Paiements->find('list', ['limit' => 200])->all();
        $carnetcheques = $this->Carnetcheques->find('list', ['limit' => 200])->all();
        $banques = $this->fetchTable('Banques')->find('list', ['keyField' => 'id', 'valueField' => 'name']);
        $cha = "TRUE";
        $clients = $this->Reglementclients->Clients->find('all');
        $importations = $this->Reglementclients->Importations->find('list', ['limit' => 200])->all();
        $utilisateurs = $this->Reglementclients->Utilisateurs->find('list', ['limit' => 200])->all();
        $exercices = $this->Reglementclients->Exercices->find('list', ['limit' => 200])->all();
        $devises = $this->Reglementclients->Devises->find('list', ['limit' => 200])->all();
        $this->set(compact('banques', 'id', 'project_id', 'mtfact', 'mtbon', 'facreg', 'piecereglementclients', 'lignesreg', 'valeurs', 'carnetcheques', 'paiements', 'cli', 'livraisons', 'factures', 'reglement', 'clients', 'importations', 'utilisateurs', 'exercices', 'devises'));
    }
    public function facturefournisseur($id = null, $project_id = null)
    {
        $this->loadModel('Factures');
        $this->loadModel('Lignefactures');
        $facture = $this->Factures->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $facture = $this->Factures->patchEntity($facture, $this->request->getData());
            if ($this->Factures->save($facture)) {
                $this->misejour("FactureFournisseurs", "edit", $id);
                $projet_id = $facture['projet_id'];
                $this->misejour("FactureFournisseurs", "edit", $projet_id);
                $this->loadModel('Projets');
                $projet = $this->Projets->get($projet_id);
                $datetimeActuelle = FrozenTime::now();
                $datetimeActuelle->format('Y-m-d H:i:s');
                $projet->datemodification = $datetimeActuelle;
                $this->Projets->save($projet);
                $this->loadModel('Lignefactures');
                $articles_ids = $this->request->getData('articles_ids');
                $codefs = $this->request->getData('codef');
                $qtes = $this->request->getData('qte');
                $prixhts = $this->request->getData('prixht');
                $remises = $this->request->getData('remise');
                $prixunhts = $this->request->getData('prixunht');
                $fodecs = $this->request->getData('fodec');
                $tvas = $this->request->getData('tva');
                $ttcs = $this->request->getData('ttc');
                $lignes = $this->Lignefactures->find()->where(["Facture_id" => $id])->all();
                foreach ($lignes as $item) {
                    $this->Lignefactures->delete($item);
                }
                if (isset($this->request->getData('data')['tabligne3']) && (!empty($this->request->getData('data')['tabligne3']))) {
                    $this->loadModel('Lignefactures');
                    foreach ($this->request->getData('data')['tabligne3'] as $i => $liv) {
                        if ($liv['sup'] != 1) {
                            $data['article_id'] = $liv['article_id'];
                            $data['facture_id'] = $id;
                            $data['qteliv'] = $liv['qte'];
                            $data['prix'] = $liv['prix'];
                            $data['remise'] = $liv['remise'];
                            $data['ht'] = $liv['ht'];
                            $data['tva'] = $liv['tva'];
                            $data['fodec'] = $liv['fodec'];
                            $data['ttc'] = $liv['ttc'];
                            $lignefactures = $this->fetchTable('Lignefactures')->newEmptyEntity();
                            $Lignefactures = $this->Lignefactures->patchEntity($lignefactures, $data);
                            if ($this->Lignefactures->save($lignefactures)) {
                            } else {
                                $this->Flash->error("Failed to create Lignefactures");
                            }
                        }
                        $this->set(compact("Lignefactures"));
                    }
                }
                return $this->redirect(['action' => 'vieww/', $project_id]);
            }
        }
        $fournisseurs = $this->Factures->Fournisseurs->find('list', ['limit' => 200]);
        $depots = $this->Factures->Depots->find('list', ['limit' => 200]);
        $cartecarburants = $this->Factures->Cartecarburants->find('list', ['limit' => 200]);
        $materieltransports = $this->Factures->Materieltransports->find('list', ['limit' => 200]);
        $lignes = $this->Lignefactures->find()->where(["Facture_id" => $id])->all();
        $count = $this->Lignefactures->find()->where(["Facture_id" => $id])->count();
        $adresselivraisonfournisseurs = $this->Factures->Adresselivraisonfournisseurs->find('list', ['keyfield' => 'id', 'valueField' => 'adresse']);
        $this->loadModel('Articles');
        $this->loadModel('Personnels');
        $this->loadModel('Lignereglements');
        $this->loadModel('Reglements');
        $this->loadModel('Piecereglements');
        $lignereglement = $this->Reglements->Lignereglements->find('all')->where(['facture_id=' . $id])->ToArray();
        $lignereglementIds = [];
        foreach ($lignereglement as $ligne) {
            $lignereglementIds[] = $ligne['id'];
        }
        $idsConcatenated = implode(', ', $lignereglementIds);
        // dd($lignereglementIds);
        if ($lignereglementIds) {
            $piecereglements = $this->Piecereglements->find('all', ['contain' => ['Banques', 'Paiements']])
                ->where(['reglement_id IN' => $lignereglementIds])
                ->toArray();
        }
        $banques = $this->fetchTable('Banques')->find('list', ['keyField' => 'id', 'valueField' => 'name']);
        $articles = $this->Articles->find('all');
        $chauffeurs = $this->Personnels->find('all')->where(["Personnels.fonction_id  ='" . 5 . "%' "]);
        $conffaieurs = $this->Personnels->find('all')->where(["Personnels.fonction_id ='" . 1 . "%' "]);
        $this->set(compact('project_id', 'banques', 'lignereglement', 'piecereglements', 'conffaieurs', 'chauffeurs', 'facture', 'lignes', 'count', 'articles', 'fournisseurs', 'adresselivraisonfournisseurs', 'depots', 'cartecarburants', 'materieltransports'));
    }
    public function editfactureclients($id = null, $project_id = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_vente' . $abrv);
        $factureclient = 0;
        foreach ($liendd as $k => $liens) {
            if (@$liens['lien'] == 'factureclients') {
                $factureclient = $liens['modif'];
            }
        }
        if (($factureclient <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $this->loadModel('Personnels');
        $this->loadModel('Lignebonlivraisons');
        $this->loadModel('Bonlivraisons');
        $this->loadModel('Factureclients');
        $factureclient = $this->Factureclients->get($id, ['contain' => ['Clients', 'Depots', 'Adresselivraisonclients'],]);
        $bonlivraison = $this->fetchTable('Bonlivraisons')->find('all', ['contain' => ['Commandes']])->where(['Bonlivraisons.id = ' . $factureclient->bonlivraison_id . '   ']);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $factureclient = $this->Factureclients->patchEntity($factureclient, $this->request->getData());
            if ($this->Factureclients->save($factureclient)) {
                $this->misejour("Factureclients", "edit", $id);
                $projet_id = $factureclient['projet_id'];
                $this->loadModel('Projets');
                $projet = $this->Projets->get($projet_id);
                $datetimeActuelle = FrozenTime::now();
                $datetimeActuelle->format('Y-m-d H:i:s');
                $projet->datemodification = $datetimeActuelle;
                $this->Projets->save($projet);
                if (isset($this->request->getData('data')['ligner']) && (!empty($this->request->getData('data')['ligner']))) {
                    foreach ($this->request->getData('data')['ligner'] as $i => $l) {
                        if ($l['sup'] != 1) {
                            $tab['bonlivraison_id'] = $id;
                            $tab['qte'] = $l['qte'];
                            $tab['article_id'] = $l['article_id'];
                            $tab['prixht'] = $l['prix'];
                            $tab['remise'] = $l['remiseligne'];
                            $tab['tva'] = $l['tva'];
                            $tab['fodec'] = $l['fodec'];
                            $tab['ttc'] = $l['ttc'];
                            if (isset($l['id']) && (!empty($l['id']))) {
                                $lignefactureclient = $this->fetchTable('Lignefactureclients')->get($l['id'], ['contain' => ['Articles']]);
                            } else {
                                $lignefactureclient = $this->fetchTable('Lignefactureclients')->newEmptyEntity();
                            };
                            $lignefactureclient = $this->fetchTable('Lignefactureclients')->patchEntity($lignefactureclient, $tab);
                            $this->fetchTable('Lignefactureclients')->save($lignefactureclient);
                        } else if (isset($l['id']) && (!empty($l['id']))) {
                            $lignefactureclient = $this->fetchTable('Lignefactureclients')->get($l['id']);
                            $this->fetchTable('Lignefactureclients')->delete($lignefactureclient);
                        }
                    }
                }
                return $this->redirect(['action' => 'index']);
            }
        }
        $this->loadModel('Articles');
        $this->loadModel('Projets');
        $this->loadModel('Reglementclients');
        $this->loadModel('Lignereglementclients');
        $this->loadModel('Piecereglementclients');
        $lignereglement = $this->Reglementclients->Lignereglementclients->find('all')->where(['factureclient_id=' . $id])->ToArray();
        $lignereglementIds = [];
        foreach ($lignereglement as $ligne) {
            $lignereglementIds[] = $ligne['id'];
        }
        $idsConcatenated = implode(', ', $lignereglementIds);
        $piecereglementclients = $this->Piecereglementclients->find('all', ['contain' => ['Banques', 'Paiements']])
            ->where(['reglementclient_id IN' => $lignereglementIds])
            ->toArray();
        $banques = $this->fetchTable('Banques')->find('list', ['keyField' => 'id', 'valueField' => 'name']);

        $lignefactureclient = $this->Factureclients->Lignefactureclients->find('all', ['contain' => ['Articles']])->where(['factureclient_id' => $id]);
        $chauffeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 5 . "%' "]);
        $convoyeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 1 . "%' "]);
        $clients = $this->Factureclients->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'Raison_Sociale']);
        $chauffeurs = $this->Personnels->find('all')->where(["Personnels.fonction_id like  '%" . 5 . "%' "]);
        $conffaieurs = $this->Personnels->find('all')->where(["Personnels.fonction_id like  '%" . 1 . "%' "]);
        $clients = $this->Factureclients->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'Raison_Sociale']);
        $pointdeventes = $this->Factureclients->Pointdeventes->find('list', ['limit' => 200]);
        $depots = $this->Factureclients->Depots->find('list', ['limit' => 200]);
        $materieltransports = $this->Factureclients->Materieltransports->find('list', ['keyfield' => 'id', 'valueField' => 'matricule']);
        $cartecarburants = $this->Factureclients->Cartecarburants->find('list', ['limit' => 200]);
        $client_id = $factureclient->client_id;
        $tim = $this->fetchTable('Timbres')->find()->select(["timbre" => 'MAX(Timbres.timbre)'])->first();
        $timbre = $tim->timbre;
        $adresselivraisonclients = $this->Factureclients->Adresselivraisonclients->find('list', ['keyfield' => 'id', 'valueField' => 'adresse'])->where(['client_id' => $client_id]);;
        $articles = $this->fetchTable('Articles')->find('all');
        $articlees = $this->fetchTable('Articles')->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation']);
        $projets = $this->fetchTable('Projets')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $clientc = $this->fetchTable('Clients')->get($factureclient->client_id, ['contain' => []]);
        $date = $factureclient->date;
        $cli = $clientc->id;
        $connection = ConnectionManager::get('default');
        $listePaiements = $connection->execute("SELECT paiement_id FROM modalites WHERE client_id = $cli")->fetchAll('assoc');
        $paiementIds = array_column($listePaiements, 'paiement_id');
        $paiementNoms = [];
        if (!empty($paiementIds)) {
            $paiementNoms = $connection->execute("SELECT id, name FROM paiements WHERE id IN (" . implode(',', $paiementIds) . ")")->fetchAll('assoc');
        }
        $options = [];
        foreach ($paiementNoms as $paiement) {
            $options[$paiement['id']] = $paiement['name'];
        }
        $modalites = $this->fetchTable('Modalites')->find('all', [
            'contain' => ['Paiements'],
        ])->where('Modalites.client_id =' . $cli);
        $date = $date->i18nFormat('yyyy-MM-dd');
        $BL = $clientc->bl;
        $incoterms = $this->fetchTable('Incoterms')->find('list', ['keyfield' => 'id', 'valueField' => 'code']);

        $this->set(compact('project_id', 'incoterms', 'banques', 'options', 'modalites', 'piecereglementclients', 'lignereglement', 'BL', 'projets', 'bonlivraison', 'timbre', 'clientc', 'factureclient', 'articlees', 'articles', 'lignefactureclient', 'clients', 'pointdeventes', 'depots', 'materieltransports', 'cartecarburants', 'chauffeurs', 'conffaieurs', 'adresselivraisonclients'));
    }
    public function etatprojet()
    {
        error_reporting(E_ERROR | E_PARSE);
        if ($this->request->is('post')) {
            $project = $this->request->getData('projet_id');
            $this->loadModel('Commandeclients');
            $this->loadModel('Demandeoffredeprixes');
            $demandeoffredeprixes = $this->Demandeoffredeprixes->find('all')->where('Demandeoffredeprixes.projet_id =' . $project);
            $boncommandes = $this->Commandeclients->find('all')->where('Commandeclients.projet_id =' . $project);
        }
        $projets = $this->Projets->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $this->set(compact('projets', 'demandeoffredeprixes', 'boncommandes'));
    }
    public function etatfinanceprojet()
    {
        error_reporting(E_ERROR | E_PARSE);
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_projet' . $abrv);
        $fournisseur = 0;
        foreach ($liendd as $k => $liens) {
            if (@$liens['lien'] == 'etatfinance') {
                $fournisseur = $liens['ajout'];
            }
        }
        if ($this->request->is('post')) {
            $project = $this->request->getData('projet_id');
            $this->loadModel('Factureclients');
            $this->loadModel('Factures');
            $factureclients = $this->Factureclients->find('all')->where('Factureclients.projet_id =' . $project);
            $factures = $this->Factures->find('all')->where('Factures.projet_id =' . $project);
        }
        $projets = $this->Projets->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $this->set(compact('projets', 'factureclients', 'factures'));
    }
    public function index()
    {




        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_projet' . $abrv);
        $projet = 0;
        foreach ($liendd as $k => $liens) {
            if (@$liens['lien'] == 'projets') {
                $projet = 1;
            }
        }
        if (($projet <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $cond1 = '';
        $cond2 = '';
        $cond3 = '';
        $cond4 = '';
        $cond5 = '';
        $cond6 = '';
        $cond7 = '';
        $cond8 = '';
        $datedebut = $this->request->getQuery('datedebut');
        $name = $this->request->getQuery('name');
        $visibilite = $this->request->getQuery('visibilite_id');
        $libelle = $this->request->getQuery('libelle');
        $datefin = $this->request->getQuery('datefin');
        $client_id = $this->request->getQuery('client_id');
        $personnel_id = $this->request->getQuery('personnel_id');
        $etat = $this->request->getQuery('etat_id');
        $opportunite_id = $this->request->getQuery('opportunite_id');

        if ($datedebut) {
            $cond1 = 'Projets.date >="' . $datedebut . '"';
        }
        if ($datefin) {
            $cond2 = 'Projets.datefin <="' . $datefin . '"';
        }
        if ($client_id) {
            $cond3 = 'Projets.client_id  ="' . $client_id . '"';
        }
        if ($personnel_id) {
            $cond3 = 'Projets.personnel_id  ="' . $personnel_id . '"';
        }
        if ($name) {
            $cond4 = 'Projets.name LIKE "%' . $name . '%"';
        }
        if ($libelle) {
            $cond5 = 'Projets.libelle LIKE "%' . $libelle . '%"';
        }
        if ($visibilite) {
            if ($visibilite == 2) {
                $cond6 = "Projets.visibilite = 1";
            } else if ($visibilite == 1) {
                $cond6 = "Projets.visibilite = 0";
            } else {
                $cond6 = "";
            }
        }
        if ($etat) {
            if ($etat == 2) {
                $cond7 = "Projets.valide = 1";
            } else if ($etat == 1) {
                $cond7 = "Projets.valide = 0";
            } else {
                $cond7 = "";
            }
        }
        if ($opportunite_id) {
            $cond8 = 'Projets.opportunite_id  ="' . $opportunite_id . '"';
        }
        $tri = $this->request->getQuery('trie');
        $orderColumn = 'Projets.id'; // Default order column

        if ($tri) {
            switch ($tri) {
                case 'client_id':
                    $orderColumn = 'Clients.nom';
                    break;
                case 'personnel_id':
                    $orderColumn = 'Personnels.nom';
                    break;
                case 'opportunite_id':
                    $orderColumn = 'Opportunites.name';
                    break;
                default:
                    $orderColumn = 'Projets.' . $tri;
                    break;
            }
        }
        $query = $this->Projets->find('all')
            ->where([$cond1, $cond2, $cond3, $cond4, $cond5, $cond6, $cond7, $cond8])
            ->order([$orderColumn => 'desc']);

        $this->paginate = [
            'contain' => ['Clients', 'Opportunites', 'Personnels'],
        ];
        $visibilites[2] = "Contacts projet";
        $visibilites[1] = "Tout le monde";
        $etats[2] = "Validé";
        $etats[1] = "Non validé";
        $projets = $this->paginate($query);
        $this->loadModel('Clients');
        $this->loadModel('Personnels');
        $this->loadModel('Opportunites');

        $personnels = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom']);
        $opportunites = $this->Opportunites->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $clients = $this->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'Raison_Sociale']);
        $projettts = $this->Projets->find('all');
        $progressData = [];

        foreach ($projets as $k => $projet) {
            $projet_id = $projet->id;
            $projet_name = $projet->libelle;

            $connection = ConnectionManager::get('default');

            $projet = $connection->execute('SELECT distinct id FROM projets where id=' . $projet_id . ';')->fetchAll('assoc');
            $demande = $connection->execute('SELECT distinct projet_id FROM demandeoffredeprixes where projet_id=' . $projet_id . ';')->fetchAll('assoc');
            $commandefournisseurs = $connection->execute('SELECT distinct projet_id FROM commandefournisseurs where projet_id=' . $projet_id . ';')->fetchAll('assoc');
            $factures = $connection->execute('SELECT distinct projet_id , Montant_Regler FROM factures where projet_id=' . $projet_id . ';')->fetchAll('assoc');
            $offreggb = $connection->execute('SELECT distinct projet_id FROM commandeclients where projet_id=' . $projet_id . ';')->fetchAll('assoc');
            $commandeclients = $connection->execute('SELECT distinct projet_id FROM commandeclients where projet_id=' . $projet_id . ' AND commandeclients.valider = 1;')->fetchAll('assoc');
            $factureclients = $connection->execute('SELECT distinct projet_id , Montant_Regler FROM factureclients where projet_id=' . $projet_id . ';')->fetchAll('assoc');
            $progress = 0;
            if (!empty($factureclients[0]['Montant_Regler']) && $factureclients[0]['Montant_Regler'] > 0) {
                $progress = 100;
            } elseif (!empty($factures[0]['Montant_Regler']) && $factures[0]['Montant_Regler']) {
                $progress = 90;
            } elseif (!empty($factureclients[0]['projet_id'])) {
                $progress = 80;
            } elseif (!empty($factures[0]['projet_id'])) {
                $progress = 70;
            } elseif (!empty($commandefournisseurs[0]['projet_id'])) {
                $progress = 60;
            } elseif (!empty($demande[0]['projet_id'])) {
                $progress = 50;
            } elseif (!empty($commandeclients[0]['projet_id'])) {
                $progress = 40;
            } elseif (!empty($offreggb[0]['projet_id'])) {
                $progress = 30;
            } elseif (!empty($projet[0]['id'])) {
                $progress = 20;
            }
            $progressData[$projet_id] = ['name' => $projet_name, 'progress' => $progress];
        }
        $this->set('progressData', $progressData);
        $listtries['date'] = 'Date';
        $listtries['datefin'] = 'Date fin';
        $listtries['client_id'] = 'Client';
        $listtries['personnel_id'] = 'Personnel';
        $listtries['name'] = 'Nom';
        $listtries['libelle'] = 'Libelle';
        $listtries['opportunite_id'] = 'Opportunite';
        $this->loadModel('Accesrecherches');
        $user_id = $this->request->getAttribute('identity')->id;
        //Configure::write('debug', true);
        $accesrecherches = $this->Accesrecherches->find('all')->where(["Accesrecherches.user_id =" . $user_id, "Accesrecherches.interface ='Projets'"])->toArray();
        $accees = [];
        foreach ($accesrecherches as $l) {
            // debug($l);die;
            $accees[$l->champ]['acces'] = $l->acces;
        }

        $this->set(compact('opportunites', 'listtries', 'tri', 'accees', 'personnels', 'projets', 'progress', 'etats', 'visibilites', 'clients'));
    }
    /**
     * View method
     *
     * @param string|null $id Projet id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $projet = $this->Projets->get($id, [
            'contain' => [],
        ]);
        $this->loadModel('Clients');
        $this->loadModel('Commandefournisseurs');
        $this->loadModel('Opportunites');
        $this->loadModel('Commercials');
        $this->loadModel('Personnels');
        $this->loadModel('Ligneprojetarticles');
        $this->loadModel('Ligneprojetfournisseurs');
        $this->loadModel('Ligneprojetclients');
        $this->loadModel('Fournisseurs');
        $this->loadModel('Articles');
        $this->loadModel('Tagcategories');
        $commercials = $this->Personnels->find('list', ['keyField' => 'id', 'valueField' => 'nom'])->where(['fonction_id' => 9]);
        $this->loadModel('Banques');
        $this->loadModel('Devises');
        $banques = $this->fetchTable('Banques')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $devises = $this->fetchTable('Devises')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $opportunites = $this->Opportunites->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $this->loadModel('Responsableprojets');
        $lignes = $this->Responsableprojets->find('all')->where('Responsableprojets.projet_id =' . $id);
        $this->loadModel('Personnels');
        $personnels = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom']);
        $commandefournisseurs = $this->Commandefournisseurs->find('all')->where(['Commandefournisseurs.projet_id =' . $id]);
        $clients = $this->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'Raison_Sociale']);
        $this->loadModel('Pdfs');
        $fichierpdfs = $this->Pdfs->find('all')->where('Pdfs.projet_id =' . $id);
        $ligneart = $this->Ligneprojetarticles->find('all')->where('Ligneprojetarticles.projet_id =' . $id);
        $lignefour = $this->Ligneprojetfournisseurs->find('all')->where('Ligneprojetfournisseurs.projet_id =' . $id);
        $lignecli = $this->Ligneprojetclients->find('all')->where('Ligneprojetclients.projet_id =' . $id);
        $articles = $this->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation']);
        $tagcategories = $this->Tagcategories->find('list', ['keyfield' => 'id', 'valueField' => 'reference']);
        $fournisseurs = $this->Fournisseurs->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        if ($projet['banque_id']) {
            $comptesBanks = $this->fetchtable('ComptesBank')->find('list', ['keyfield' => 'id', 'valueField' => 'compte'])->where(['ComptesBank.banque_id' => $projet['banque_id']]);
        }
        $this->set(compact('devises', 'comptesBanks', 'tagcategories', 'fournisseurs', 'articles', 'ligneart', 'lignefour', 'lignecli', 'banques', 'fichierpdfs', 'projet', 'commercials', 'lignes', 'personnels', 'commandefournisseurs', 'clients', 'opportunites'));
    }
    public function view010324($id = null)
    {
        $projet = $this->Projets->get($id, [
            'contain' => [],
        ]);
        $this->loadModel('Clients');
        $this->loadModel('Commandefournisseurs');
        $this->loadModel('Opportunites');
        $this->loadModel('Commercials');
        $this->loadModel('Personnels');
        // $this->loadModel('Tagcategories');
        $commercials = $this->Personnels->find('list', ['keyField' => 'id', 'valueField' => 'nom'])->where(['fonction_id' => 9]);


        $this->loadModel('Banques');
        $this->loadModel('Devises');
        $banques = $this->fetchTable('Banques')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $devises = $this->fetchTable('Devises')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $opportunites = $this->Opportunites->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $this->loadModel('Responsableprojets');
        $lignes = $this->Responsableprojets->find('all')->where('Responsableprojets.projet_id =' . $id);
        $this->loadModel('Personnels');
        $personnels = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom']);
        $commandefournisseurs = $this->Commandefournisseurs->find('all')->where(['Commandefournisseurs.projet_id =' . $id]);
        $clients = $this->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'nom']);
        $this->loadModel('Pdfs');
        $fichierpdfs = $this->Pdfs->find('all')->where('Pdfs.projet_id =' . $id);
        $this->set(compact('devises', 'banques', 'fichierpdfs', 'projet', 'commercials', 'lignes', 'personnels', 'commandefournisseurs', 'clients', 'opportunites'));
    }
    public function addclients($index = null)
    {
        $this->loadModel('Clients');
        // debug($prospect_id);
        if ($prospect_id == '1') {
            $session = $this->request->getSession();
            $abrv = $session->read('abrvv');
            $liendd = $session->read('lien_prévisionnement' . $abrv);
            $client = 0;
            foreach ($liendd as $k => $liens) {
                if (@$liens['lien'] == 'clients') {
                    $client = $liens['ajout'];
                }
            }
            if (($client <> 1)) {
                $this->redirect(array('controller' => 'users', 'action' => 'login'));
            }
        } else if ($prospect_id == '3') {
            $session = $this->request->getSession();
            $abrv = $session->read('abrvv');
            $liendd = $session->read('lien_prévisionnement' . $abrv);
            $client = 0;
            foreach ($liendd as $k => $liens) {
                if (@$liens['lien'] == 'clients') {
                    $client = $liens['ajout'];
                }
            }
            if (($client <> 1)) {
                $this->redirect(array('controller' => 'users', 'action' => 'login'));
            }
        }
        $num = $this->Clients->find()->select([
            "num" =>
            'MAX(Clients.Code)'
        ])->first();
        $numero = $num->num;

        if ($numero != null) {

            $currentNumber = intval(substr($numero, 1, 5));

            $newNumber = $currentNumber + 1;

            $formattedNumber = str_pad((string) $newNumber, 5, '0', STR_PAD_LEFT);


            $code = 'C' . $formattedNumber;
        } else {
            $code = "C00001";
        }


        $dhouha = $prospect_id;
        $client = $this->Clients->newEmptyEntity();
        if ($this->request->is('post')) {
            $data['nom'] = $this->request->getData('nom');
            $data['Raison_Sociale'] = $this->request->getData('Raison_Sociale');
            $data['client'] = $this->request->getData('prospect_id');
            $data['codeclient'] = $this->request->getData('codeclient');
            $data['fournisseur'] = $this->request->getData('fournisseur');
            $data['codefr'] = $this->request->getData('codefr');
            $data['etat'] = $this->request->getData('etat');
            $data['Adresse'] = $this->request->getData('Adresse');
            $data['Code'] = $this->request->getData('Code');
            $data['Code_Ville'] = $this->request->getData('Code_Ville');
            $data['pay_id'] = $this->request->getData('pay_id');
            $data['gouvernorat_id'] = $this->request->getData('gouvernorat_id');
            $data['Tel'] = $this->request->getData('Tel');
            $data['Fax'] = $this->request->getData('Fax');
            $data['modalite'] = $this->request->getData('modalite');
            $data['Contact'] = $this->request->getData('Contact');
            $data['RC'] = $this->request->getData('RC');
            $data['Matricule_Fiscale'] = $this->request->getData('Matricule_Fiscale');
            $data['codedouane'] = $this->request->getData('codedouane');
            $data['BAN'] = $this->request->getData('BAN');
            $data['R_TVA'] = $this->request->getData('R_TVA');
            $data['numerotva'] = $this->request->getData('numerotva');
            $data['typetiers'] = $this->request->getData('typetier_id');
            $data['salaris'] = $this->request->getData('salari_id');
            $data['typeentite'] = $this->request->getData('typeentite_id');
            $data['Capital'] = $this->request->getData('Capital');
            $data['incoterms'] = $this->request->getData('incoterm_id');
            $data['devise_id'] = $this->request->getData('devise_id');
            $data['port'] = $this->request->getData('port');
            $data['commercial_id'] = $this->request->getData('commercial_id');
            $logo = $this->request->getData('logo');
            $name = $logo->getClientFilename();
            $targetPath = WWW_ROOT . 'img' . DS . 'logoclients' . DS . $name;
            if ($name) {
                $logo->moveTo($targetPath);
                $data['logo'] = $name;
            }
            $client = $this->Clients->patchEntity($client, $data);
            if ($this->Clients->save($client)) {
                if ($this->Clients->save($client)) {
                    $this->loadModel('Modalites');
                    $client_id = $client->id;
                    if (isset($this->request->getData('data')['tabligne3']) && (!empty($this->request->getData('data')['tabligne3']))) {
                        foreach ($this->request->getData('data')['tabligne3'] as $i => $l) {
                            if (isset($client_id)) {
                                $ta = $this->fetchTable('Modalites')->newEmptyEntity();
                                $ta['client_id'] = $client_id;
                                $ta['paiement_id'] = $l['paiement_id'];
                                $ta['duree'] = $l['duree'];
                                $this->fetchTable('Modalites')->save($ta);
                            }
                        }
                    }
                    $this->loadModel('Tags');
                    $client_id = $client->id;
                    if ((!empty($this->request->getData('tag_id')))) {
                        $this->loadModel('Tags');
                        foreach ($this->request->getData('tag_id') as $responsable) {
                            $dataa['client_id'] = $client_id;
                            $dataa['pay_id'] = $responsable;
                            $tags = $this->fetchTable('Tags')->newEmptyEntity();
                            $tags = $this->Tags->patchEntity($tags, $dataa);
                            $this->Tags->save($tags);
                        }
                    }
                    $id = $client->id;
                    $clients = $this->fetchTable('Clients')->find('All');
                    $select = "<select   name='data[lignec][" . $index . "][client_id]' class='form-control'  champ='client_id' id='client_id" . $index . "' style = 'text-align:right'>";
                    $select = $select . "<option value=''></option>";
                    foreach ($clients as $cl) {
                        if ($cl['id'] == $id) {
                            $selected = "selected";
                        } else {
                            $selected = "";
                        }
                        $select = $select . "<option value=" . $cl['id'] . " " . $selected . " >" . $cl['Raison_Sociale'] . " </option>";
                    }
                    $select = $select . '</select>';
                ?>
                    <script>
                        var selec t = `<?php echo $select; ?>`;
                        window.opener.document.getElementById('client_id<?php echo $index; ?>').innerHTML = select;
                        window.close();
                    </script>
                <?php
                }
            }
        }
        $this->loadModel('Gouvernorats');
        $this->loadModel('Pays');
        $this->loadModel('Devises');
        $this->loadModel('Commercials');
        $this->loadModel('Typetiers');
        $this->loadModel('Salaris');
        $this->loadModel('Typeentites');
        $this->loadModel('Incoterms');
        $this->loadModel('Prospects');
        $this->loadModel('Paiements');
        $this->loadModel('Personnels');
        $commercials = $this->Personnels->find('list', ['keyField' => 'id', 'valueField' => 'nom'])->where(['fonction_id' => 9]);
        $paiements = $this->fetchTable('Paiements')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $prospects = $this->fetchTable('Prospects')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $incoterms = $this->fetchTable('Incoterms')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $typeentites = $this->fetchTable('Typeentites')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $salaris = $this->fetchTable('Salaris')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $typetiers = $this->fetchTable('Typetiers')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $devises = $this->fetchTable('Devises')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $gouvernorats = $this->fetchTable('Gouvernorats')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $pays = $this->fetchTable('Pays')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $tags = $this->fetchTable('Pays')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        // $typoo = $this->fetchTable('Prospects')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->where('Prospects.id =' . $prospect_id);
        // foreach ($typoo as $typ) {
        //     $dd = $typ;
        // }
        $this->set(compact('code', 'paiements', 'dd', 'client', 'dhouha', 'gouvernorats', 'pays', 'devises', 'commercials', 'tags', 'typetiers', 'salaris', 'typeentites', 'incoterms', 'prospects'));
    }
    public function addtous0($index = null)
    {
        $this->loadModel('Clients');

        $client = $this->Clients->newEmptyEntity();
        if ($this->request->is('post')) {
            $data['nom'] = $this->request->getData('nom');
            $data['Raison_Sociale'] = $this->request->getData('Raison_Sociale');
            $data['client'] = $this->request->getData('prospect_id');
            $data['codeclient'] = $this->request->getData('codeclient');
            $data['fournisseur'] = $this->request->getData('fournisseur');
            $data['codefr'] = $this->request->getData('codefr');
            $data['etat'] = $this->request->getData('etat');
            $data['Adresse'] = $this->request->getData('Adresse');
            $data['Code'] = $this->request->getData('Code');
            $data['Code_Ville'] = $this->request->getData('Code_Ville');
            $data['pay_id'] = $this->request->getData('pay_id');
            $data['gouvernorat_id'] = $this->request->getData('gouvernorat_id');
            $data['Tel'] = $this->request->getData('Tel');
            $data['Fax'] = $this->request->getData('Fax');
            $data['Contact'] = $this->request->getData('Contact');
            $data['modalite'] = $this->request->getData('modalite');
            $data['RC'] = $this->request->getData('RC');
            $data['Matricule_Fiscale'] = $this->request->getData('Matricule_Fiscale');
            $data['codedouane'] = $this->request->getData('codedouane');
            $data['BAN'] = $this->request->getData('BAN');
            $data['R_TVA'] = $this->request->getData('R_TVA');
            $data['numerotva'] = $this->request->getData('numerotva');
            $data['typetiers'] = $this->request->getData('typetier_id');
            $data['salaris'] = $this->request->getData('salari_id');
            $data['typeentite'] = $this->request->getData('typeentite_id');
            $data['Capital'] = $this->request->getData('Capital');
            $data['incoterms'] = $this->request->getData('incoterm_id');
            $data['devise_id'] = $this->request->getData('devise_id');
            $data['port'] = $this->request->getData('port');
            $data['commercial_id'] = $this->request->getData('commercial_id');
            $logo = $this->request->getData('logo');
            $name = $logo->getClientFilename();
            $targetPath = WWW_ROOT . 'img' . DS . 'logoclients' . DS . $name;
            if ($name) {
                $logo->moveTo($targetPath);
                $data['logo'] = $name;
            }
            $this->loadModel('Clients');
            $client = $this->Clients->patchEntity($client, $data);
            if ($this->Clients->save($client)) {
                $this->loadModel('Tags');
                $client_id = $client->id;
                if ((!empty($this->request->getData('tag_id')))) {
                    $this->loadModel('Tags');
                    $tags = $this->fetchTable('Tags')->newEmptyEntity();
                    $dataa['client_id'] = $client_id;
                    $dataa['pay_id'] = $this->request->getData('tag_id');
                    $tags = $this->Tags->patchEntity($tags, $dataa);
                    if ($this->Tags->save($tags)) {
                    }
                }
                $this->loadModel('Clients');

                $id = $client->id;
                $client = $this->Clients->query('SELECT clients.id id, clients.Raison_Sociale name from clients');
                // $select = "<select   name='data[CommandeClients][client_id]' class='form-control'  champ='client_id' id='client_id' style = 'text-align:right'>";
                $select = "<select   name='data[lignec][" . $index . "][client_id]' class='form-control'  champ='client_id' id='client_id" . $index . "' style = 'text-align:right'>";

                $select = $select . "<option value=''></option>";
                foreach ($client as $f) {
                    if ($f['id'] == $id) {
                        $selected = "selected";
                    } else {
                        $selected = "";
                    }
                    $select = $select . "<option value=" . $f['id'] . " " . $selected . " >" . $f['Raison_Sociale'] . " </option>";
                }
                $select = $select . '</select>'; ?>
                <script>
                    / /
                    alert(<?php echo $select; ?>) window.opener.document.getElementById('client_id<?php echo $index; ?>').innerHTML = "azertyuio";
                    window.close();
                </script>
            <?php
            }
        }
        $this->loadModel('Gouvernorats');
        $this->loadModel('Pays');
        $this->loadModel('Devises');
        $this->loadModel('Commercials');
        $this->loadModel('Typetiers');
        $this->loadModel('Salaris');
        $this->loadModel('Typeentites');
        $this->loadModel('Incoterms');
        $this->loadModel('Prospects');
        $prospects = $this->fetchTable('Prospects')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $incoterms = $this->fetchTable('Incoterms')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $typeentites = $this->fetchTable('Typeentites')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $salaris = $this->fetchTable('Salaris')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $typetiers = $this->fetchTable('Typetiers')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $commercials = $this->fetchTable('Commercials')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $devises = $this->fetchTable('Devises')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $gouvernorats = $this->fetchTable('Gouvernorats')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $pays = $this->fetchTable('Pays')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $tags = $this->fetchTable('Pays')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $this->set(compact('client', 'gouvernorats', 'pays', 'devises', 'commercials', 'tags', 'typetiers', 'salaris', 'typeentites', 'incoterms', 'prospects'));
    }
    public function addtous($index = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_prévisionnement' . $abrv);
        $client = 0;
        foreach ($liendd as $k => $liens) {
            if (@$liens['lien'] == 'clients') {
                $client = $liens['ajout'];
            }
        }
        if (($client <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $this->loadModel('Clients');
        $client = $this->Clients->newEmptyEntity();
        if ($this->request->is('post')) {
            $data['nom'] = $this->request->getData('nom');
            $data['Raison_Sociale'] = $this->request->getData('Raison_Sociale');
            $data['client'] = $this->request->getData('prospect_id');
            $data['codeclient'] = $this->request->getData('codeclient');
            $data['fournisseur'] = $this->request->getData('fournisseur');
            $data['codefr'] = $this->request->getData('codefr');
            $data['etat'] = $this->request->getData('etat');
            $data['Adresse'] = $this->request->getData('Adresse');
            $data['Code'] = $this->request->getData('Code');
            $data['Code_Ville'] = $this->request->getData('Code_Ville');
            $data['pay_id'] = $this->request->getData('pay_id');
            $data['gouvernorat_id'] = $this->request->getData('gouvernorat_id');
            $data['Tel'] = $this->request->getData('Tel');
            $data['Fax'] = $this->request->getData('Fax');
            $data['Contact'] = $this->request->getData('Contact');
            $data['modalite'] = $this->request->getData('modalite');
            $data['RC'] = $this->request->getData('RC');
            $data['Matricule_Fiscale'] = $this->request->getData('Matricule_Fiscale');
            $data['codedouane'] = $this->request->getData('codedouane');
            $data['BAN'] = $this->request->getData('BAN');
            $data['R_TVA'] = $this->request->getData('R_TVA');
            $data['numerotva'] = $this->request->getData('numerotva');
            $data['typetiers'] = $this->request->getData('typetier_id');
            $data['salaris'] = $this->request->getData('salari_id');
            $data['typeentite'] = $this->request->getData('typeentite_id');
            $data['Capital'] = $this->request->getData('Capital');
            $data['incoterms'] = $this->request->getData('incoterm_id');
            $data['devise_id'] = $this->request->getData('devise_id');
            $data['port'] = $this->request->getData('port');
            $data['commercial_id'] = $this->request->getData('commercial_id');
            $logo = $this->request->getData('logo');
            $name = $logo->getClientFilename();
            $targetPath = WWW_ROOT . 'img' . DS . 'logoclients' . DS . $name;
            if ($name) {
                $logo->moveTo($targetPath);
                $data['logo'] = $name;
            }
            $client = $this->Clients->patchEntity($client, $data);
            if ($this->Clients->save($client)) {
                $this->loadModel('Tags');
                $client_id = $client->id;
                if ((!empty($this->request->getData('tag_id')))) {
                    $this->loadModel('Tags');
                    $tags = $this->fetchTable('Tags')->newEmptyEntity();
                    $dataa['client_id'] = $client_id;
                    $dataa['pay_id'] = $this->request->getData('tag_id');
                    $tags = $this->Tags->patchEntity($tags, $dataa);
                    if ($this->Tags->save($tags)) {
                    }
                }
                $this->loadModel('Clients');
                $id = $client->id;
                $clients = $this->Clients->query('SELECT clients.id id, clients.Raison_Sociale name from clients');
                $select = "<select   name='data[lignec][" . $index . "][client_id]' class='form-control'  champ='client_id' id='client_id" . $index . "' style = 'text-align:right'>";
                $select = $select . "<option value=''></option>";
                foreach ($clients as $cl) {
                    if ($cl['id'] == $id) {
                        $selected = "selected";
                    } else {
                        $selected = "";
                    }
                    $select = $select . "<option value=" . $cl['id'] . " " . $selected . " >" . $cl['Raison_Sociale'] . " </option>";
                }
                $select = $select . '</select>';
            ?>
                <script>
                    //  aler                t();      //   var select = "<? php // echo $select;                                                                               
                                                                            ?>";      window.opener.document.getElementById('cliselect< ?php echo $index; ?>').innerHTML = "< ?php echo $select; ?>";     window.close();
                </script>
            <?php
            }
        }
        $this->loadModel('Swift');
        $this->loadModel('Gouvernorats');
        $this->loadModel('Pays');
        $this->loadModel('Devises');
        $this->loadModel('Commercials');
        $this->loadModel('Typetiers');
        $this->loadModel('Salaris');
        $this->loadModel('Typeentites');
        $this->loadModel('Incoterms');
        $this->loadModel('Prospects');
        $this->loadModel('Banques');
        $banques = $this->fetchTable('Banques')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $prospects = $this->fetchTable('Prospects')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $incoterms = $this->fetchTable('Incoterms')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $typeentites = $this->fetchTable('Typeentites')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $salaris = $this->fetchTable('Salaris')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $typetiers = $this->fetchTable('Typetiers')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $commercials = $this->fetchTable('Personnels')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $devises = $this->fetchTable('Devises')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $gouvernorats = $this->fetchTable('Gouvernorats')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $pays = $this->fetchTable('Pays')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $tags = $this->fetchTable('Pays')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $this->set(compact('client', 'gouvernorats', 'pays', 'devises', 'commercials', 'tags', 'typetiers', 'salaris', 'typeentites', 'incoterms', 'prospects'));
    }

    public function addfour2902()
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_prévisionnement' . $abrv);
        $fournisseur = 0;
        foreach ($liendd as $k => $liens) {
            if (@$liens['lien'] == 'fournisseurs') {
                $fournisseur = $liens['ajout'];
            }
        }
        if (($fournisseur <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }

        $num = $this->Fournisseurs->find()->select([
            "num" =>
            'MAX(Fournisseurs.code)'
        ])->first();
        $numero = $num->num;
        if ($numero != null) {
            $currentNumber = intval(substr($numero, 1, 5));
            $newNumber = $currentNumber + 1;
            $formattedNumber = str_pad((string) $newNumber, 5, '0', STR_PAD_LEFT);
            $code = 'F' . $formattedNumber;
        } else {
            $code = "F00001";
        }

        $fournisseur = $this->Fournisseurs->newEmptyEntity();
        if ($this->request->is('post')) {
            $data['name'] = $this->request->getData('nom');
            $data['nomalternatif'] = $this->request->getData('nomalert');
            $data['prospect_id'] = $this->request->getData('prospect_id');
            $data['codecl'] = $this->request->getData('codeclient');
            $data['fournisseur'] = $this->request->getData('fournisseur');
            $data['code'] = $this->request->getData('codefr');
            $data['activite'] = $this->request->getData('etat');
            $data['adresse'] = $this->request->getData('Adresse');
            $data['codepostal'] = $this->request->getData('Code');
            $data['compte_comptable'] = $this->request->getData('compte_comptable');
            $data['villes'] = $this->request->getData('Code_Ville');
            $data['pay_id'] = $this->request->getData('pay_id');
            $data['gouvernorat_id'] = $this->request->getData('gouvernorat_id');
            $data['tel'] = $this->request->getData('Tel');
            $data['fax'] = $this->request->getData('Fax');
            $data['site'] = $this->request->getData('site');
            $data['mail'] = $this->request->getData('Email');

            $data['RC'] = $this->request->getData('RC');
            $data['matricule_fiscale'] = $this->request->getData('Matricule_Fiscale');
            $data['codedouane'] = $this->request->getData('codedouane');
            $data['BAN'] = $this->request->getData('BAN');
            $data['ajusterTVA'] = $this->request->getData('R_TVA');
            $data['numTVA'] = $this->request->getData('numerotva');
            $data['typetier_id'] = $this->request->getData('typetier_id');
            $data['salari_id'] = $this->request->getData('salari_id');
            $data['typeentite_id'] = $this->request->getData('typeentite_id');
            $data['capital'] = $this->request->getData('Capital');
            $data['incoterm_id'] = $this->request->getData('incoterm_id');
            $data['devise_id'] = $this->request->getData('devise_id');
            $data['port'] = $this->request->getData('port');
            $data['categorie_id'] = $this->request->getData('categorie_id');
            $data['commercial'] = $this->request->getData('commercial_id');
            $logo = $this->request->getData('logo');
            $name = $logo->getClientFilename();
            $targetPath = WWW_ROOT . 'img' . DS . 'logofournisseurs' . DS . $name;
            if ($name) {
                $logo->moveTo($targetPath);
                $data['logo'] = $name;
            }
            $fournisseur = $this->Fournisseurs->patchEntity($fournisseur, $data);
            if ($this->Fournisseurs->save($fournisseur)) {
                $this->loadModel('Tagsfour');
                $fournisseur_id = $fournisseur->id;
                foreach ($this->request->getData('categorie_id') as $j => $l) {
                    // dd($l);
                    if ((!empty($this->request->getData('categorie_id')))) {

                        $tags = $this->fetchTable('Tagsfour')->newEmptyEntity();
                        $dataa['fournisseurs_id'] = $fournisseur_id;
                        $dataa['categorie_id'] = $l;
                        $tags = $this->Tagsfour->patchEntity($tags, $dataa);
                        $this->Tagsfour->save($tags);
                        // debug($tags);
                    }
                }
                // if ($this->Tagsfour->save($tags)) {
                $fournisseur_id = $fournisseur->id;
                if (isset($this->request->getData('data')['tabligne3']) && (!empty($this->request->getData('data')['tabligne3']))) {
                    foreach ($this->request->getData('data')['tabligne3'] as $i => $l) {
                        if (isset($fournisseur_id)) {
                            if ($l['sup'] != 1) {
                                $ta = $this->fetchTable('Swift')->newEmptyEntity();
                                $ta['fournisseur_id'] = $fournisseur_id;
                                $ta['code'] = $l['code'];
                                $ta['banque_id'] = $l['banque_id'];
                                $ta['domc'] = $l['domc'];
                                $ta['rib'] = $l['rib'];
                                $this->fetchTable('Swift')->save($ta);
                            }
                        }
                    }
                }
                // }

                if (isset($fournisseur_id) && isset($article_id)) {
                    $article_id = $this->request->getData('article_id');
                    $article = $this->fetchTable('Articles')->find('all')->where(['Articles.id' => $article_id])->first();
                    $article->fournisseur_id = $fournisseur_id;
                    $this->fetchTable('Articles')->save($article);
                }
            }
            return $this->redirect(['action' => 'index']);
        }
        $this->loadModel('Swift');
        $this->loadModel('Gouvernorats');
        $this->loadModel('Listetags');
        $this->loadModel('Devises');
        $this->loadModel('Commercials');
        $this->loadModel('Typetiers');
        $this->loadModel('Salaris');
        $this->loadModel('Typeentites');
        $this->loadModel('Incoterms');
        $this->loadModel('Prospects');
        $this->loadModel('Banques');
        $banques = $this->fetchTable('Banques')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $prospects = $this->fetchTable('Prospects')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $incoterms = $this->fetchTable('Incoterms')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $typeentites = $this->fetchTable('Typeentites')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $salaris = $this->fetchTable('Salaris')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $typetiers = $this->fetchTable('Typetiers')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        // $commercials = $this->fetchTable('Commercials')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $commercials = $this->fetchTable('Personnels')->find('list', ['keyfield' => 'id', 'valueField' => 'nom']);
        $user_id = $this->request->getAttribute('identity')->id;
        $user = $this->fetchTable('Users')->find('all')->where(['id' => $user_id])->first();
        $personnel_id = $user->personnel_id;
        // $articles = $this->fetchTable('Articles')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $articles = $this->fetchTable('Articles')->find('list', [
            'keyfield' => 'id',
            'valueField' => function ($article) {
                return $article->Dsignation . ' (' . $article->Code . ') ';
            }
        ]);
        $categories = $this->fetchTable('Categories')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $devises = $this->fetchTable('Devises')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $gouvernorats = $this->fetchTable('Gouvernorats')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $pays = $this->fetchTable('Pays')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $tags = $this->fetchTable('Listetags')->find('list', ['keyfield' => 'id', 'valueField' => 'tag'])->all();
        $this->set(compact('code', 'categories', 'personnel_id', 'articles', 'fournisseur', 'banques', 'gouvernorats', 'pays', 'devises', 'commercials', 'tags', 'typetiers', 'salaris', 'typeentites', 'incoterms', 'prospects'));
    }

    public function addfournisseur($index = null)
    {
        $this->loadModel('Fournisseurs');
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_prévisionnement' . $abrv);
        $fournisseur = 0;
        foreach ($liendd as $k => $liens) {
            if (@$liens['lien'] == 'fournisseurs') {
                $fournisseur = $liens['ajout'];
            }
        }
        if (($fournisseur <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $num = $this->Fournisseurs->find()->select([
            "num" =>
            'MAX(Fournisseurs.code)'
        ])->first();
        $numero = $num->num;
        if ($numero != null) {
            $currentNumber = intval(substr($numero, 1, 5));
            $newNumber = $currentNumber + 1;
            $formattedNumber = str_pad((string) $newNumber, 5, '0', STR_PAD_LEFT);
            $code = 'F' . $formattedNumber;
        } else {
            $code = "F00001";
        }

        $fournisseur = $this->Fournisseurs->newEmptyEntity();
        if ($this->request->is('post')) {
            $data['name'] = $this->request->getData('nom');
            $data['nomalternatif'] = $this->request->getData('nomalert');
            $data['prospect_id'] = $this->request->getData('prospect_id');
            $data['codecl'] = $this->request->getData('codeclient');
            $data['fournisseur'] = $this->request->getData('fournisseur');
            $data['code'] = $this->request->getData('codefr');
            $data['activite'] = $this->request->getData('etat');
            $data['adresse'] = $this->request->getData('Adresse');
            $data['codepostal'] = $this->request->getData('Code');
            $data['compte_comptable'] = $this->request->getData('compte_comptable');
            $data['villes'] = $this->request->getData('Code_Ville');
            $data['pay_id'] = $this->request->getData('pay_id');
            $data['gouvernorat_id'] = $this->request->getData('gouvernorat_id');
            $data['tel'] = $this->request->getData('Tel');
            $data['fax'] = $this->request->getData('Fax');
            $data['site'] = $this->request->getData('site');
            $data['mail'] = $this->request->getData('Email');

            $data['RC'] = $this->request->getData('RC');
            $data['matricule_fiscale'] = $this->request->getData('Matricule_Fiscale');
            $data['codedouane'] = $this->request->getData('codedouane');
            $data['BAN'] = $this->request->getData('BAN');
            $data['ajusterTVA'] = $this->request->getData('R_TVA');
            $data['numTVA'] = $this->request->getData('numerotva');
            $data['typetier_id'] = $this->request->getData('typetier_id');
            $data['salari_id'] = $this->request->getData('salari_id');
            $data['typeentite_id'] = $this->request->getData('typeentite_id');
            $data['capital'] = $this->request->getData('Capital');
            $data['incoterm_id'] = $this->request->getData('incoterm_id');
            $data['devise_id'] = $this->request->getData('devise_id');
            $data['port'] = $this->request->getData('port');
            $data['categorie_id'] = $this->request->getData('categorie_id');
            $data['commercial'] = $this->request->getData('commercial_id');
            $logo = $this->request->getData('logo');
            $name = $logo->getClientFilename();
            $targetPath = WWW_ROOT . 'img' . DS . 'logofournisseurs' . DS . $name;
            if ($name) {
                $logo->moveTo($targetPath);
                $data['logo'] = $name;
            }
            $fournisseur = $this->Fournisseurs->patchEntity($fournisseur, $data);
            if ($this->Fournisseurs->save($fournisseur)) {
                $this->loadModel('Tagsfour');
                $fournisseur_id = $fournisseur->id;
                if (isset($this->request->getData('data')['tabligne3']) && (!empty($this->request->getData('data')['tabligne3']))) {
                    foreach ($this->request->getData('data')['tabligne3'] as $i => $l) {
                        if (isset($fournisseur_id)) {
                            if ($l['sup'] != 1) {
                                $ta = $this->fetchTable('Swift')->newEmptyEntity();
                                $ta['fournisseur_id'] = $fournisseur_id;
                                $ta['code'] = $l['code'];
                                $ta['banque_id'] = $l['banque_id'];
                                $ta['domc'] = $l['domc'];
                                $ta['rib'] = $l['rib'];
                                $this->fetchTable('Swift')->save($ta);
                            }
                        }
                    }
                }
                // }

                if (isset($fournisseur_id) && isset($article_id)) {
                    $article_id = $this->request->getData('article_id');
                    $article = $this->fetchTable('Articles')->find('all')->where(['Articles.id' => $article_id])->first();
                    $article->fournisseur_id = $fournisseur_id;
                    $this->fetchTable('Articles')->save($article);
                }
                $id = $fournisseur->id;
                $fournisseurs = $this->Fournisseurs->query('SELECT  fournisseurs.id id,  fournisseurs.name  name from  fournisseurs');
                //   $select = "<select   name='data[lignef][" . $index . "][fournisseur_id]' class='form-control'  champ='fournisseur_id' id='fournisseur_id" . $index . "' style = 'text-align:right'>";
                $select = "<option value=''></option>";
                foreach ($fournisseurs as $f) {
                    if ($f['id'] == $id) {
                        $selected = "selected";
                    } else {
                        $selected = "";
                    }
                    $select = $select . "<option value=" . $f['id'] . " " . $selected . " >" . $f['name'] . " </option>";
                }
                //$select = $select . '</select>';
            ?>
                <script>
                    var select = `<?php echo $select; ?>`;
                    window.opener.document.getElementById('fournisseur_id<?php echo $index; ?>').innerHTML = select;
                    window.close();
                </script>
            <?php
            }
        }
        $this->loadModel('Swift');
        $this->loadModel('Gouvernorats');
        $this->loadModel('Listetags');
        $this->loadModel('Devises');
        $this->loadModel('Commercials');
        $this->loadModel('Typetiers');
        $this->loadModel('Salaris');
        $this->loadModel('Typeentites');
        $this->loadModel('Incoterms');
        $this->loadModel('Prospects');
        $this->loadModel('Banques');
        $banques = $this->fetchTable('Banques')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $prospects = $this->fetchTable('Prospects')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $incoterms = $this->fetchTable('Incoterms')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $typeentites = $this->fetchTable('Typeentites')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $salaris = $this->fetchTable('Salaris')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $typetiers = $this->fetchTable('Typetiers')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        // $commercials = $this->fetchTable('Commercials')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $commercials = $this->fetchTable('Personnels')->find('list', ['keyfield' => 'id', 'valueField' => 'nom']);
        $user_id = $this->request->getAttribute('identity')->id;
        $user = $this->fetchTable('Users')->find('all')->where(['id' => $user_id])->first();
        $personnel_id = $user->personnel_id;
        // $articles = $this->fetchTable('Articles')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $articles = $this->fetchTable('Articles')->find('list', [
            'keyfield' => 'id',
            'valueField' => function ($article) {
                return $article->Dsignation . ' (' . $article->Code . ') ';
            }
        ]);
        $categories = $this->fetchTable('Categories')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $devises = $this->fetchTable('Devises')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $gouvernorats = $this->fetchTable('Gouvernorats')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $pays = $this->fetchTable('Pays')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $tags = $this->fetchTable('Listetags')->find('list', ['keyfield' => 'id', 'valueField' => 'tag'])->all();
        $this->set(compact('code', 'categories', 'personnel_id', 'articles', 'fournisseur', 'banques', 'gouvernorats', 'pays', 'devises', 'commercials', 'tags', 'typetiers', 'salaris', 'typeentites', 'incoterms', 'prospects'));
    }
    public function addarticle($index = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_articles' . $abrv);
        $article = 0;
        foreach ($liendd as $k => $liens) {
            if (@$liens['lien'] == 'article') {
                $article = $liens['ajout'];
            }
        }
        if (($article <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $this->loadModel('Articles');
        $article = $this->Articles->newEmptyEntity();
        if ($this->request->is('post')) {
            $article = $this->Articles->patchEntity($article, $this->request->getData());
            $image = $this->request->getData('image_file');
            //debug($logo);
            $name = $image->getClientFilename();
            $targetPath = WWW_ROOT . 'img' . DS . $name;
            if ($name) {
                $image->moveTo($targetPath);
                //$data['fichier'] = $name;
                $article->image = $name;
            }
            if ($this->Articles->save($article)) {
                $id = $article->id;
                if (!empty($this->request->getData('data')['lignef']) && isset($this->request->getData('data')['lignef'])) {
                    foreach ($this->request->getData('data')['lignef'] as $lignefou) {
                        if ($lignefou['sup1'] != 1) {
                            $this->loadModel('Articlefournisseurs');
                            $articlefournisseurs = $this->fetchTable('Articlefournisseurs')->newEmptyEntity();
                            $data['article_id'] = $id;
                            $data['fournisseur_id'] = $lignefou['fournisseur_id'];
                            $data['prix'] = $lignefou['prix'];
                            $articlefournisseurs = $this->Articlefournisseurs->patchEntity($articlefournisseurs, $data);
                            $this->Articlefournisseurs->save($articlefournisseurs);
                        }
                    }
                }
                $id = $article->id;
                $articles = $this->Articles->query('SELECT articles.id id, articles.Dsignation Dsignation from articles');
                $select = "<select   name='data[lignea][" . $index . "][article_id]' class='form-control'  champ='article_id' id='article_id" . $index . "' style = 'text-align:right'>";
                $select = $select . "<option value=''></option>";
                foreach ($articles as $f) {
                    if ($f['id'] == $id) {
                        $selected = "selected";
                    } else {
                        $selected = "";
                    }
                    $select = $select . "<option value=" . $f['id'] . " " . $selected . " >" . $f['Dsignation'] . " </option>";
                }
                $select = $select . '</select>';
            ?>
                <script>
                    var select = `<?php echo $select; ?>`;
                    window.opener.document.getElementById('article_id<?php echo $index; ?>').innerHTML = select;
                    window.close();
                </script>
            <?php
            }
        }
        $this->loadModel('Pays');
        $this->loadModel('Unites');
        $this->loadModel('Categories');
        $this->loadModel('Tvas');
        $this->loadModel('Codecomptables');
        $codecomptableventes = $this->fetchTable('Codecomptables')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->where('Codecomptables.typecode = 1');
        $codecomptableexports = $this->fetchTable('Codecomptables')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->where('Codecomptables.typecode = 2');
        $codecomptableachats = $this->fetchTable('Codecomptables')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->where('Codecomptables.typecode = 3');
        $tvas = $this->fetchTable('Tvas')->find('list', ['keyfield' => 'id', 'valueField' => 'valeur']);
        $categories = $this->fetchTable('Categories')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $unites = $this->fetchTable('Unites')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $pays = $this->fetchTable('Pays')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $this->loadModel('Typearticles');
        $typearticles = $this->fetchTable('Typearticles')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $this->loadModel('Fournisseurs');
        $fournisseurs = $this->fetchTable('Fournisseurs')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $souscategories = $this->Articles->Souscategories->find('list', ['limit' => 200])->all();
        $this->set(compact('article', 'fournisseurs', 'codecomptableventes', 'codecomptableexports', 'codecomptableachats', 'tvas', 'unites', 'pays', 'categories', 'typearticles', 'souscategories'));
    }
    public function addarticlefr($index = null, $idfr = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_articles' . $abrv);
        $article = 0;
        foreach ($liendd as $k => $liens) {
            if (@$liens['lien'] == 'article') {
                $article = $liens['ajout'];
            }
        }
        if (($article <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $this->loadModel('Articles');
        $article = $this->Articles->newEmptyEntity();
        if ($this->request->is('post')) {
            $article = $this->Articles->patchEntity($article, $this->request->getData());
            $image = $this->request->getData('image_file');
            //debug($logo);
            $name = $image->getClientFilename();
            $targetPath = WWW_ROOT . 'img' . DS . $name;
            if ($name) {
                $image->moveTo($targetPath);
                //$data['fichier'] = $name;
                $article->image = $name;
            }
            if ($this->Articles->save($article)) {
                $id = $article->id;
                if (!empty($this->request->getData('data')['lignef']) && isset($this->request->getData('data')['lignef'])) {
                    foreach ($this->request->getData('data')['lignef'] as $lignefou) {
                        if ($lignefou['sup1'] != 1) {
                            $this->loadModel('Articlefournisseurs');
                            $articlefournisseurs = $this->fetchTable('Articlefournisseurs')->newEmptyEntity();
                            $data['article_id'] = $id;
                            $data['fournisseur_id'] = $lignefou['fournisseur_id'];
                            $data['prix'] = $lignefou['prix'];
                            $articlefournisseurs = $this->Articlefournisseurs->patchEntity($articlefournisseurs, $data);
                            $this->Articlefournisseurs->save($articlefournisseurs);
                        }
                    }
                }
                //  debug($article->fournisseur_id);
                $id = $article->id;
                $articles = $this->fetchTable('Articles')->find('all')->where(['Articles.typearticle=1', 'Articles.fournisseur_id=' . $article->fournisseur_id]);

                //  $articles = $this->Articles->query('SELECT articles.id id, articles.Dsignation Dsignation from articles where fournisseur_id='.$article->fournisseur_id.';');
                //  debug($articles->toArray());die;
                // $select = "<select   name='data[lignecommandeclients][" . $index . "][article_id]' class='form-control'  champ='article_id' id='article_id" . $index . "' style = 'text-align:right'>";
                $select = "<option value=''></option>";
                foreach ($articles as $f) {
                    if ($f['id'] == $id) {
                        $selected = "selected";
                    } else {
                        $selected = "";
                    }
                    $select = $select . "<option value=" . $f['id'] . " " . $selected . " >" . $f['Dsignation'] . " </option>";
                }
                // $select = $select . '</select>';
            ?>
                <script>
                    var select = `<?php echo $select; ?>`;
                    window.opener.document.getElementById('article_id<?php echo $index; ?>').innerHTML = select;
                    window.close();
                </script>
            <?php
            }
        }
        $this->loadModel('Pays');
        $this->loadModel('Unites');
        $this->loadModel('Categories');
        $this->loadModel('Tvas');
        $this->loadModel('Codecomptables');
        $codecomptableventes = $this->fetchTable('Codecomptables')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->where('Codecomptables.typecode = 1');
        $codecomptableexports = $this->fetchTable('Codecomptables')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->where('Codecomptables.typecode = 2');
        $codecomptableachats = $this->fetchTable('Codecomptables')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->where('Codecomptables.typecode = 3');
        $tvas = $this->fetchTable('Tvas')->find('list', ['keyfield' => 'id', 'valueField' => 'valeur']);
        $categories = $this->fetchTable('Categories')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $unites = $this->fetchTable('Unites')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $pays = $this->fetchTable('Pays')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $this->loadModel('Typearticles');
        $typearticles = $this->fetchTable('Typearticles')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $this->loadModel('Fournisseurs');
        $fournisseurs = $this->fetchTable('Fournisseurs')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->where(['id' => $idfr]);
        $souscategories = $this->Articles->Souscategories->find('list', ['limit' => 200])->all();
        $this->set(compact('article', 'fournisseurs', 'codecomptableventes', 'codecomptableexports', 'codecomptableachats', 'tvas', 'unites', 'pays', 'categories', 'typearticles', 'souscategories'));
    }
    public function addcommmm($type = null)
    {
        $this->loadModel('Personnels');
        if ($type == 13) {
            $session = $this->request->getSession();
            $abrv = $session->read('abrvv');
            $liendd = $session->read('lien_zones' . $abrv);
            $logistique = 0;
            foreach ($liendd as $k => $liens) {
                if (@$liens['lien'] == 'logistiques') {
                    $logistique = $liens['ajout'];
                }
            }
            if (($logistique <> 1)) {
                $this->redirect(array('controller' => 'users', 'action' => 'login'));
            }
        } else if ($type == 10) {
            $session = $this->request->getSession();
            $abrv = $session->read('abrvv');
            $liendd = $session->read('lien_zones' . $abrv);
            $financier = 0;
            foreach ($liendd as $k => $liens) {
                if (@$liens['lien'] == 'financiers') {
                    $financier = $liens['ajout'];
                }
            }
            if (($financier <> 1)) {
                $this->redirect(array('controller' => 'users', 'action' => 'login'));
            }
        } else if ($type == 9) {
            $session = $this->request->getSession();
            $abrv = $session->read('abrvv');
            $liendd = $session->read('lien_zones' . $abrv);
            $commercial = 0;
            foreach ($liendd as $k => $liens) {
                if (@$liens['lien'] == 'percommercials') {
                    $commercial = $liens['ajout'];
                }
            }
            if (($commercial <> 1)) {
                $this->redirect(array('controller' => 'users', 'action' => 'login'));
            }
        } else if ($type == 14) {
            $session = $this->request->getSession();
            $abrv = $session->read('abrvv');
            $liendd = $session->read('lien_zones' . $abrv);
            $transporteur = 0;
            foreach ($liendd as $k => $liens) {
                if (@$liens['lien'] == 'transporteurs') {
                    $transporteur = $liens['ajout'];
                }
            }
            if (($transporteur <> 1)) {
                $this->redirect(array('controller' => 'users', 'action' => 'login'));
            }
        }


        $personnel = $this->Personnels->newEmptyEntity();
        if ($this->request->is('post')) {
            $personnel = $this->Personnels->patchEntity($personnel, $this->request->getData());
            $image = $this->request->getData('image_file');
            $name = $image->getClientFilename();
            $targetPath = WWW_ROOT . 'img' . DS . 'imgpersonnels' . DS . $name;
            if (!empty($name)) {
                $image->moveTo($targetPath);
                $personnel->image = $name;
            }
            if ($this->Personnels->save($personnel)) {
                $personnel_id = ($this->Personnels->save($personnel)->id);
                $this->misejour("Personnels", "add", $personnel_id);
                $id = $personnel->id;
                $personnels = $this->Personnels->query('SELECT personnels.id id, personnels.name name from personnels');
                $select = "<select   name='data[personnel][personnel_id]' class='form-control'  champ='personnel_id' id='personnel_id' style = 'text-align:right'>";
                $select = $select . "<option value=''></option>";
                foreach ($personnels as $f) {
                    if ($f['id'] == $id) {
                        $selected = "selected";
                    } else {
                        $selected = "";
                    }
                    $select = $select . "<option value=" . $f['id'] . " " . $selected . " >" . $f['nom'] . " </option>";
                }
                $select = $select . '</select>';
            ?>
                <script language="javascript">
                    window.opener.document.getElementById('commercial_id').innerHTML = "<?php echo $select; ?>";
                </script>
                <script language="javascript">
                    window.close();
                </script>
            <?php
            }
        }
        $fonctions = $this->Personnels->Fonctions->find('list', ['limit' => 200]);
        $sexes = $this->Personnels->Sexes->find('list', ['limit' => 200]);
        $situationfamiliales = $this->Personnels->Situationfamiliales->find('list', ['limit' => 200]);
        $typecontrats = $this->Personnels->Typecontrats->find('list', ['limit' => 200]);
        $pointdeventes = $this->Personnels->Pointdeventes->find('list', ['limit' => 200]);
        $numeroobj = $this->Personnels->find()->select([
            "numerox" =>
            'MAX(Personnels.code)'
        ])->first();
        $numero = $numeroobj->numerox;
        if ($numero != null) {
            $n = $numero;
            $lastnum = $n;
            $nume = intval($lastnum) + 1;
            $nn = (string) $nume;
            $code = str_pad($nn, 5, "0", STR_PAD_LEFT);
        } else {
            $code = "00001";
        }
        $nomfonction = $this->Personnels->Fonctions->find('all')->where('Fonctions.id =' . $type)->first();
        $noml = $nomfonction->name;
        $this->set(compact('personnel', 'noml', 'type', 'fonctions', 'sexes', 'situationfamiliales', 'typecontrats', 'pointdeventes', 'code'));
    }
    public function addcomm()
    {
        $this->loadModel('Commercials');
        $this->loadModel('Mois');
        $mois = $this->fetchTable('Mois')->find('all', ['keyfield' => 'id', 'valueField' => 'name']);
        $this->loadModel('Tarifs');
        $this->loadModel('Articles');
        $articles = $this->fetchTable('Articles')->find('all')->where(['Articles.famille_id = 1']);
        $commercial = $this->Commercials->newEmptyEntity();
        if ($this->request->is('post')) {
            $this->loadModel('Gouvernoratcommercials');
            $commercial = $this->Commercials->patchEntity($commercial, $this->request->getData());
            if ($this->Commercials->save($commercial)) {
                $commercial_id = $commercial->id;
                if (isset($this->request->getData('data')['objectifrep']) && (!empty($this->request->getData('data')['objectifrep']))) {
                    foreach ($this->request->getData('data')['objectifrep'] as $i => $c) {
                        $this->loadModel('Objectifrepresentants');
                        $objectifrepresentant = $this->fetchTable('Objectifrepresentants')->newEmptyEntity();
                        $dataobj['commercial_id'] = $commercial_id;
                        $dataobj['objectif'] = $c['objectif'];
                        $dataobj['article_id'] = $c['article'];
                        $dataobj['moi_id'] = $c['mois'];
                        if (!empty($c['objectif'])) {
                            $objectifrepresentant = $this->fetchTable('Objectifrepresentants')->patchEntity($objectifrepresentant, $dataobj);
                            $this->fetchTable('Objectifrepresentants')->save($objectifrepresentant);
                        }
                    }
                }
                if (isset($this->request->getData('data')['Gouvernorat']) && (!empty($this->request->getData('data')['Gouvernorat']))) {
                    foreach ($this->request->getData('data')['Gouvernorat'] as $j => $gouv) {
                        if ($gouv['sup'] != 1) {
                            foreach ($gouv['Client'] as $j => $cl) {
                                if (isset($cl['checkclient']) && (!empty($cl['checkclient'])) && $cl['checkclient'] == 1) {
                                    $clientg = $this->fetchTable('Gouvernoratcommercials')->newEmptyEntity();
                                    $data['client_id'] = $cl['client_id'];
                                    $data['commercial_id'] = $commercial_id;
                                    $data['gouvernorat_id'] = $gouv['gouvernorat_id'];
                                    $clientg = $this->fetchTable('Gouvernoratcommercials')->patchEntity($clientg, $data);
                                    $this->fetchTable('Gouvernoratcommercials')->save($clientg);
                                }
                            }
                        }
                    }
                }
                $id = $commercial->id;
                $commercials = $this->Personnels->query('SELECT commercials.id id, commercials.name name from commercials');
                // $select = "<select   name='data[commercial][commercial_id]' class='form-control'  champ='commercial_id' id='commercial_id' style = 'text-align:right'>";
                $select = "<option value=''></option>";
                foreach ($commercials as $f) {
                    if ($f['id'] == $id) {
                        $selected = "selected";
                    } else {
                        $selected = "";
                    }
                    $select = $select . "<option value=" . $f['id'] . " " . $selected . " >" . $f['name'] . " </option>";
                }
                //  $select = $select . '</select>';
            ?>
                <script language="javascript">
                    window.opener.document.getElementById('commercial_id').innerHTML = "<?php echo $select; ?>";
                </script>
                <script language="javascript">
                    window.close();
                </script>
            <?php
            }
        }
        $this->loadModel('Gouvernorats');
        $gouveee = $this->fetchTable('Gouvernorats')->find('all', ['keyfield' => 'id', 'valueField' => 'name']);
        $gouvernorats = $this->Commercials->Gouvernorats->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $categories = $this->Commercials->Categories->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $this->set(compact('gouveee', 'articles', 'commercial', 'gouvernorats', 'categories', 'mois'));
    }
    public function vieww($id = null, $com = null)
    {
        // $com=$this->Session->read('com');
        $session = $this->request->getSession();
        //$com = $session->read('com');
        //var_dump($com);
        $user_id = $this->request->getAttribute('identity')->id;
        $user = $this->fetchTable('Users')->find('all')->where(['Users.id' => $user_id])->first();
        $mail = $user->mail;
        $validation = $user->validation;
        $project_id = $id;
        $typeof = 1;
        $projets = $this->Projets->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $projet = $this->Projets->find()
            ->select(['name'])
            ->where(['id' => $project_id])
            ->first();
        $name = $projet->name;
        $chart_title = "Etat d'avancement du projet " . $name;
        $this->loadModel('Commandeclients');
        $this->loadModel('Pdfs');
        $this->loadModel('Responsableprojets');
        $this->loadModel('Fournisseurs');
        $this->loadModel('Articles');
        $this->loadModel('Commandefournisseurs');
        $this->loadModel('Lignecommandefournisseurs');
        $this->loadModel('Lignedemandeoffredeprixes');
        $this->loadModel('Tacheassigns');
        $this->loadModel('Demandeoffredeprixes');
        $this->loadModel('Personnels');
        $this->loadModel('Clients');
        $this->loadModel('Projets');
        $this->loadModel('Tvas');
        $this->loadModel('Opportunites');
        $this->loadModel('Notes');
        $this->loadModel('Contrats');
        $this->loadModel('Modetransports');
        $this->loadModel('Lignecommandeclients');
        $this->loadModel('Commercials');
        $this->loadModel('Taches');
        $this->loadModel('Paiements');
        $connection = ConnectionManager::get('default');
        //         $bandeconsultationnn =$connection->execute("ALTER TABLE `commandefournisseurs` ADD `pay` VARCHAR(255) NULL");
        // die;

        $query = 'SELECT COUNT(*) AS count FROM factures WHERE projet_id = :projet_id';
        $nbfacturesachat = $connection->execute($query, ['projet_id' => $project_id])->fetchAll('assoc');
        $countachat = $nbfacturesachat[0]['count'];
        $query2 = 'SELECT COUNT(*) AS count FROM factureclients WHERE projet_id = :projet_id';
        $nbfacturesvente = $connection->execute($query2, ['projet_id' => $project_id])->fetchAll('assoc');
        $countvente = $nbfacturesvente[0]['count'];
        $querymontantachat = 'SELECT SUM(ttc) AS total FROM factures WHERE projet_id = :projet_id';
        $totalMontantAchat = $connection->execute($querymontantachat, ['projet_id' => $project_id])->fetch('assoc')['total'];
        $querymontantVente = 'SELECT SUM(totalttc) AS total FROM factureclients WHERE projet_id = :projet_id';
        $totalMontantVente = $connection->execute($querymontantVente, ['projet_id' => $project_id])->fetch('assoc')['total'];
        $queryReglementAchat = 'SELECT SUM(Montant_Regler) AS total FROM factures WHERE projet_id = :projet_id';
        $totalReglementAchat = $connection->execute($queryReglementAchat, ['projet_id' => $project_id])->fetch('assoc')['total'];
        $queryReglementVente = 'SELECT SUM(Montant_Regler) AS total FROM factureclients WHERE projet_id = :projet_id';
        $totalReglementVente = $connection->execute($queryReglementVente, ['projet_id' => $project_id])->fetch('assoc')['total'];
        $projet = $connection->execute('SELECT distinct id FROM projets where id=' . $project_id . ';')->fetchAll('assoc');
        $demande = $connection->execute('SELECT distinct projet_id FROM demandeoffredeprixes where projet_id=' . $project_id . ';')->fetchAll('assoc');
        $commandefournisseurs = $connection->execute('SELECT distinct projet_id FROM commandefournisseurs where projet_id=' . $project_id . ';')->fetchAll('assoc');
        $factures = $connection->execute('SELECT distinct projet_id FROM factures where projet_id=' . $project_id . ';')->fetchAll('assoc');
        $offreggb = $connection->execute('SELECT distinct projet_id FROM commandeclients where projet_id=' . $project_id . ';')->fetchAll('assoc');
        $commandeclients = $connection->execute('SELECT distinct projet_id FROM commandeclients where projet_id=' . $project_id . ' AND commandeclients.valider = 1;')->fetchAll('assoc');
        $factureclients = $connection->execute('SELECT distinct projet_id , Montant_Regler FROM factureclients where projet_id=' . $project_id . ';')->fetchAll('assoc');
        $progress = 0;
        if (!empty($factureclients[0]['Montant_Regler']) && $factureclients[0]['Montant_Regler'] > 0) {
            $progress = 100;
        } elseif (!empty($factureclients[0]['projet_id'])) {
            $progress = 85;
        } elseif (!empty($commandeclients[0]['projet_id'])) {
            $progress = 70;
        } elseif (!empty($offreggb[0]['projet_id'])) {
            $progress = 60;
        } elseif (!empty($factures[0]['projet_id'])) {
            $progress = 45;
        } elseif (!empty($commandefournisseurs[0]['projet_id'])) {
            $progress = 30;
        } elseif (!empty($demande[0]['projet_id'])) {
            $progress = 15;
        } elseif (!empty($projet[0]['id'])) {
            $progress = 5;
        }



        $projet = $this->Projets->newEmptyEntity();
        if ($this->request->is(['patch', 'post', 'put'])) {

            $formName = $this->request->getData('form_name');


            $session = $this->request->getSession();
            $session->write('com', null);

            //  debug($this->request->getData());die;

            $fichierpdfexit = $this->Pdfs->find('all')->where('Pdfs.projet_id =' . $id);
            $ligneexistes = $this->Responsableprojets->find('all')->where('Responsableprojets.projet_id =' . $id);
            // $lignenotes = $this->Notes->find('all')->where('Notes.projet_id =' . $id);
            // foreach ($lignenotes as $n) {
            //     $this->Notes->delete($n);
            // }
            if ($com != null) {
                # code...

                $notes = $this->Notes->find('all')->where(['Notes.commandeclient_id=' . $com])->first();
                //debug($notes);
                if (empty($notes)) {
                    $notes = $this->Notes->newEmptyEntity();
                }

                $data['commandeclient_id'] = $com;
                $data['projet_id'] = $id;
                $data['notepub'] = $this->request->getData('note_publique');
                $data['noteprive'] = $this->request->getData('note_prive');
                $data['user_id'] = $this->request->getData('user_id');
                //debug($this->request->getData('user_id'));
                $notes = $this->Notes->patchEntity($notes, $data);
                // debug($notes);
                $this->Notes->save($notes);
                // debug($notes);
                // die;
                if (empty($notes)) {
                    $this->misejour("Notes", "add", $id);
                } else {
                    $this->misejour("Notes", "edit", $id);
                }
            }


            if ($formName == 'detailprojet') {
                $projet_id = $id;
                $this->loadModel('Projets');
                $projet = $this->Projets->get($projet_id);
                $datetimeActuelle = FrozenTime::now();
                $datetimeActuelle->format('Y-m-d H:i:s');
                $projet->datemodification = $datetimeActuelle;
                $this->Projets->save($projet);
                foreach ($ligneexistes as $l) {
                    $this->Responsableprojets->delete($l);
                }
                if (isset($this->request->getData('data')['ligne']) && (!empty($this->request->getData('data')['ligne']))) {
                    foreach ($this->request->getData('data')['ligne'] as $i => $ligne) {
                        if ($ligne['sup1'] != 1) {
                            $responsableprojets = $this->Responsableprojets->newEmptyEntity();
                            $data['projet_id'] = $project_id;
                            $data['personnel_id'] = $ligne['personnel_id'];
                            $responsableprojets = $this->Responsableprojets->patchEntity($responsableprojets, $data);
                            $this->Responsableprojets->save($responsableprojets);
                            $this->misejour("Responsables de projets", "edit", $id);
                            $projet_id = $responsableprojets['projet_id'];
                            $this->loadModel('Projets');
                            $projet = $this->Projets->get($projet_id);
                            $datetimeActuelle = FrozenTime::now();
                            $datetimeActuelle->format('Y-m-d H:i:s');
                            $projet->datemodification = $datetimeActuelle;
                            $this->Projets->save($projet);
                        }
                    }
                }
                if (isset($this->request->getData('data')['fichier']) && (!empty($this->request->getData('data')['fichier']))) {
                    foreach ($this->request->getData('data')['fichier'] as $i => $exon) {

                        $this->loadModel('Exonerations');
                        if ($exon['sup1'] != 1) {
                            $data['projet_id'] = $project_id;
                            if (isset($exon['id']) && (!empty($exon['id']))) {
                                $fichPdfs = $this->fetchTable('Pdfs')->get($exon['id'], [
                                    'contain' => []
                                ]);
                            } else {
                                $fichPdfs = $this->fetchTable('Pdfs')->newEmptyEntity();
                            };
                            $logo = $exon['pdf'];
                            if (!empty($logo)) {
                                $name = $logo->getClientFilename();
                                $targetPath = WWW_ROOT . 'img' . DS . 'logoclients' . DS . $name;
                                if ($name) {
                                    $logo->moveTo($targetPath);
                                    $data['fichier'] = $name;
                                }
                            }
                            $fichPdfs = $this->fetchTable('Pdfs')->patchEntity($fichPdfs, $data);
                            if ($this->fetchTable('Pdfs')->save($fichPdfs)) {
                                $this->misejour("Pdfs", "edit", $id);
                                $projet_id = $fichPdfs['projet_id'];
                                $this->loadModel('Projets');
                                $projet = $this->Projets->get($projet_id);
                                $datetimeActuelle = FrozenTime::now();
                                $datetimeActuelle->format('Y-m-d H:i:s');
                                $projet->datemodification = $datetimeActuelle;
                                $this->Projets->save($projet);
                            } else {
                            }
                        } else {
                            if (!empty($exon['id']))
                                $fichPdfs = $this->fetchTable('Pdfs')->get($exon['id']);
                            $this->fetchTable('Pdfs')->delete($fichPdfs);
                        }
                    }
                }
            }


            // ***************************Projetconceptions******************************************************************************
            if ($formName == 'projetconception') {
                $projetconception = $this->fetchTable('Projetconceptions')->find()->where('projet_id=' . $id)->first();
                if (!$projetconception) {
                    $projetconception = $this->fetchTable('Projetconceptions')->newEmptyEntity();
                }

                $projetconception->personnel_id = $this->request->getData('personnel_id');
                $projetconception->refconception = $this->request->getData('refconception');
                $projetconception->typeconception_id = $this->request->getData('typeconception_id');
                $projetconception->numeroreservation = $this->request->getData('numeroreservation');
                $projetconception->dateconception = $this->request->getData('dateconception');
                $projetconception->projet_id = $id;


                $this->fetchTable('Projetconceptions')->save($projetconception);
            }

            // ***************************Projetcommercial******************************************************************************
            if ($formName == 'projetcommercial') {

                $projetcommercial = $this->fetchTable('Projetcommercials')->find()->where('projet_id=' . $id)->first();
                if (!$projetcommercial) {
                    $projetcommercial = $this->fetchTable('Projetcommercials')->newEmptyEntity();
                }



                $projetcommercial->verificationdossier = $this->request->getData('verificationdossier') ? 1 : 0;
                $projetcommercial->evaluationcout = $this->request->getData('evaluationcout') ? 1 : 0;

                $projetcommercial->datecommercial = $this->request->getData('datecommercial');
                $projetcommercial->projet_id = $id;

                $this->fetchTable('Projetcommercials')->save($projetcommercial);
            }

            // ***************************Projetfinance******************************************************************************
            if ($formName == 'projetfinance') {

                $projetfinance = $this->fetchTable('Projetfinances')->find()->where('projet_id=' . $id)->first();
                if (!$projetfinance) {
                    $projetfinance = $this->fetchTable('Projetfinances')->newEmptyEntity();
                }

                $projetfinance->verificationdevis = $this->request->getData('verificationdevis') ? 1 : 0;
                $projetfinance->verificationpaiement = $this->request->getData('verificationpaiement') ? 1 : 0;

                $projetfinance->datefinance = $this->request->getData('datefinance');
                $projetfinance->projet_id = $id;

                $this->fetchTable('Projetfinances')->save($projetfinance);
            }

            // *********************************Projetproductions***********************************************
            if ($formName == 'projetproduction') {

                if (isset($this->request->getData('data')['ligneprod']) && (!empty($this->request->getData('data')['ligneprod']))) {
                    foreach ($this->request->getData('data')['ligneprod'] as $i => $ligne) {

                        $ligneprojetproduction = [];
                        if ($ligne['idppp']!=null){
                        $ligneprojetproduction = $this->fetchTable('Projetproductions')->find('all')->where(['id' => $ligne['idppp']])->first();
                        }
                        if (empty($ligneprojetproduction)) {
                            $ligneprojetproduction = $this->fetchTable('Projetproductions')->newEmptyEntity();
                        }

                        $ligneprojetproduction->parametrageproduction_id = $ligne['idparam'];
                        $ligneprojetproduction->planifier = isset($ligne['planifier']) ? 1 : 0;
                        $ligneprojetproduction->numero_of = $ligne['numero_of'];
                        $ligneprojetproduction->reel = isset($ligne['reel']) ? 1 : 0;
                        $ligneprojetproduction->projet_id = $id;


                        $this->fetchTable('Projetproductions')->save($ligneprojetproduction);
                    }
                }
            }



            return $this->redirect(['action' => 'vieww/' . $project_id]);
        }
        $this->loadModel('Commandeclients');
        $this->loadModel('Personnels');
        if ($com != null) {
            $commandeclient = $this->Commandeclients->get($com, [
                'contain' => ['Lignecommandeclients'],
            ]);
            debug($commandeclient);

            $this->loadModel('Clients');
            $this->loadModel('Projets');
            $projets = $this->fetchTable('Projets')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
            $clients = $this->fetchTable('Clients')->find('list', ['keyfield' => 'id', 'valueField' => 'nom']);
            $chauffeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 5 . "%' "]);
            $convoyeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 1 . "%' "]);
            $pointdeventes = $this->Commandeclients->Pointdeventes->find('list', ['limit' => 200]);
            $depots = $this->Commandeclients->Depots->find('list', ['limit' => 200]);
            $cartecarburants = $this->Commandeclients->Cartecarburants->find('list', ['limit' => 200]);
            $materieltransports = $this->Commandeclients->Materieltransports->find('list', ['limit' => 200]);
            $bonlivraisons = $this->Commandeclients->Bonlivraisons->find('list', ['limit' => 200]);
            $this->loadModel('Lignecommandeclients');
            // $lignecommandeclients = $this->Commandeclients->Lignecommandeclients->find('all')->where(["Lignecommandeclients.commandeclient_id=" . $id . " "])->ToArray();
            // debug($id);
            $connection = ConnectionManager::get('default');
            $lignecommandeclients = $connection->execute("SELECT lc.* FROM lignecommandeclients lc INNER JOIN ( SELECT article_id, MAX(prixht) AS max_price FROM lignecommandeclients WHERE commandeclient_id='" . $com . "' GROUP BY article_id) AS max_prices ON lc.article_id = max_prices.article_id AND lc.prixht = max_prices.max_price WHERE lc.commandeclient_id='" . $com . "'")->fetchAll('assoc');
            //debug($commandeclient);

            $this->loadModel('Articles');
            $articles = $this->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Articles.typearticle = 1"]);
            $articleservices = $this->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Articles.typearticle = 2"]);
            // $devises = $this->fetchTable('Devises')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
            $devises = $this->fetchTable('Devises')->find('list', [
                'keyfield' => 'id',
                'valueField' => function ($d) {
                    return $d->name . ' (' . $d->symbole . ')';
                }
            ]);
            $incoterms = $this->fetchTable('Incoterms')->find('list', ['keyfield' => 'id', 'valueField' => 'code']);
            $connection = ConnectionManager::get('default');
            $code = '-1';

            if ($commandeclient['devis_id']) {
                $devise = $connection->execute("SELECT code FROM devises WHERE id='" . $commandeclient['devis_id'] . "'")->fetch('assoc');
                // debug($devise);die;
                $code = $devise['code'];
                $deviseprojet2 = $devise['code'];
            }
            $incotermpdfs = $this->fetchTable('Incoterms')->find('list', ['keyfield' => 'id', 'valueField' => 'code']);
            $this->loadModel('Paiements');
            $paiements = $this->Paiements->find('list', ['keyfield' => 'id', 'valueField' => 'name']);


            if ($commandeclient['paiement_id']) {
                $gg = explode(" ", $commandeclient['paiement_id']);
            }

            $Clientpaiement = $this->fetchTable('Clientpaiements')->find('all')->where('Clientpaiements.commandeclient_id =' . $com);
            $gg = [];
            foreach ($Clientpaiement as $itemm) {

                array_push($gg, $itemm['paiement_id']);
            }
            $pays = $this->fetchTable('Pays')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
            //debug($gg) ;
            $modetransports = $this->fetchTable('Modetransports')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
            // debug($lignecommandeclients);die;
            $unites = $this->fetchTable('Unites')->find('all');
            //debug($articles->toArray());
            $fournisseurs = $this->Demandeoffredeprixes->Fournisseurs->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
            $conditionreglements = $this->fetchTable('Conditionreglements')->find('list', ['keyfield' => 'id', 'valueField' => 'conditionn']);
            $delailivraisons = $this->fetchTable('Delailivraisons')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
            $methodeexpeditions = $this->fetchTable('Methodeexpeditions')->find('list', ['keyfield' => 'id', 'valueField' => 'methode']);
            if ($commandeclient['devisachat_id']) {

                $pro = $connection->execute("SELECT code FROM devises WHERE id=" . $commandeclient['devisachat_id'] . " ")->fetch('assoc');
                ///  debug($pro);//die;
                $deviseprojet = $pro['code'];
                //debug($deviseprojet);
            }



            $this->set(compact('methodeexpeditions', 'deviseprojet2', 'comptesBanks', 'banques', 'deviseprojet', 'delailivraisons', 'conditionreglements', 'articleservices', 'fournisseurs', 'unites', 'project_id', 'gg', 'modetransports', 'pays', 'paiements', 'incotermpdfs', 'devises', 'incoterms', 'code', 'lignecommandeclients', 'articles', 'commandeclient', 'clients', 'projets', 'depots', 'cartecarburants', 'materieltransports', 'chauffeurs', 'convoyeurs', 'bonlivraisons'));
        }
        $conditionreglements = $this->fetchTable('Conditionreglements')->find('list', ['keyfield' => 'id', 'valueField' => 'conditionn']);
        $delailivraisons = $this->fetchTable('Delailivraisons')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $methodeexpeditions = $this->fetchTable('Methodeexpeditions')->find('list', ['keyfield' => 'id', 'valueField' => 'methode']);
        $projets = $this->fetchTable('Projets')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $pays = $this->fetchTable('Pays')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $fournisseurs = $this->Demandeoffredeprixes->Fournisseurs->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $articles = $this->Demandeoffredeprixes->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])
            ->where(["Articles.vente = 1"]);

        $num = $this->Commandefournisseurs->find()->select([
            "numdepot" =>
            'MAX(Commandefournisseurs.numero)'
        ])->first();
        $numero = $num->numdepot;
        $n = 0;
        $n = $numero;
        if (!empty($n)) {
            $ff = intval(substr($n, 3, 7)) + 1;
            $z = str_pad("$ff", 5, '0', STR_PAD_LEFT);
            $num_commandefournisseur = str_pad("$z", 6, 'C', STR_PAD_LEFT);
        } else {
            $n = "C00001";
            $z = str_pad(" $n", 5, '0', STR_PAD_LEFT);
            $num_commandefournisseur = str_pad("$z", 6, 'C', STR_PAD_LEFT);
        }
        $client_id_result = $this->Projets->find('all', [
            'fields' => ['Projets.client_id'],
            'conditions' => ['Projets.id' => $id],
        ]);
        $client_id = $client_id_result->first()->client_id;
        if ($client_id != 0) {
            $projet_client = $this->Clients->find()
                ->select(['Raison_Sociale'])
                ->where(["Clients.id" => $client_id])
                ->first();
        }
        $Projet_name = $this->Projets->find()
            ->select(['name'])
            ->where(["Projets.id" => $id])
            ->first();
        $numeroobj = $this->Commandeclients->find()->select([
            "numerox" =>
            'MAX(Commandeclients.code)'
        ])->first();
        $numero = $numeroobj->numerox;
        if ($numero != null) {
            $n = $numero;
            $lastnum = $n;
            $nume = intval($lastnum) + 1;
            $nn = (string) $nume;
            $code = str_pad($nn, 6, "0", STR_PAD_LEFT);
        } else {
            $code = "000001";
        }

        $projet = $this->Projets->get($id, [
            'contain' => (['Clients', 'Opportunites', 'Personnels']),
        ]);;
        $query = $this->Contrats->find('all')->where(['Contrats.projet_id' => $id]);

        $this->paginate = ['contain' => ['Projets', 'Clients', 'Personnels'],];
        $contrats = $this->paginate($query);
        $currentDate = new \DateTime();
        $formattedDate = $currentDate->format('Y-m-d');
        $date = new FrozenTime('now', 'Africa/Tunis');
        $dateAujourdhui = $date->i18nFormat('dd/MM/yyyy HH:mm:ss');
        $assignepar = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 9 . "%' "]);
        $assignea = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id !=  '%" . 9 . "%' "]);
        $chauffeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 5 . "%' "]);
        $convoyeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 1 . "%' "]);
        $tvas = $this->fetchTable('Tvas')->find('list', ['keyfield' => 'id', 'valueField' => 'valeur']);
        $projets = $this->fetchTable('Projets')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $clients = $this->fetchTable('Clients')->find('list', ['keyfield' => 'id', 'valueField' => 'nom']);
        $pointdeventes = $this->Commandeclients->Pointdeventes->find('list', ['limit' => 200]);
        $depots = $this->Commandeclients->Depots->find('list', ['limit' => 200]);
        $cartecarburants = $this->Commandeclients->Cartecarburants->find('list', ['limit' => 200]);
        $materieltransports = $this->Commandeclients->Materieltransports->find('list', ['limit' => 200]);
        $bonlivraisons = $this->Commandeclients->Bonlivraisons->find('list', ['limit' => 200]);
        $articles = $this->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'nom']); //->where(["Articles.vente = 1"]);
        $commandefournisseurs = $this->fetchTable('Commandefournisseurs')->find()->where(['Commandefournisseurs.projet_id' => $id])->order(['Commandefournisseurs.id' => 'desc'])->all();
        // debug($commandefournisseurs);
        $facturefournisseurs = $this->fetchTable('Factures')->find('all')->where(['Factures.projet_id' => $id])->group(['Factures.id'])->order(['Factures.id' => 'DESC'])->toArray();
        $commercials = $this->Personnels->find('list', ['keyField' => 'id', 'valueField' => 'nom'])->where(['fonction_id' => 9]);
        $offreggb = $this->fetchTable('Commandeclients')->find('all')->where(['Commandeclients.projet_id' => $id])->contain(['Clients', 'Notes'])->group(['Commandeclients.id'])->order(['Commandeclients.id' => 'DESC'])->toArray();
        $listdemandeoffre = $this->fetchTable('Demandeoffredeprixes')->find('all')->where(['Demandeoffredeprixes.projet_id' => $id])->group(['Demandeoffredeprixes.id'])->order(['Demandeoffredeprixes.id' => 'DESC'])->toArray();
        $commandeclients = $this->fetchTable('Commandeclients')->find()->where(['Commandeclients.projet_id' => $id, 'Commandeclients.valider' => 1])->contain(['Clients'])->all();
        $factureclients = $this->fetchTable('Factureclients')->find('all')->where(['Factureclients.projet_id' => $id])->group(['Factureclients.id'])->order(['Factureclients.id' => 'DESC'])->toArray();
        $projets = $this->fetchTable('Projets')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $clients = $this->fetchTable('Clients')->find('list', ['keyfield' => 'id', 'valueField' => 'nom']);
        $chauffeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 5 . "%' "]);
        $convoyeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 1 . "%' "]);
        $pointdeventes = $this->Commandeclients->Pointdeventes->find('list', ['limit' => 200]);
        $depots = $this->Commandeclients->Depots->find('list', ['limit' => 200]);
        $cartecarburants = $this->Commandeclients->Cartecarburants->find('list', ['limit' => 200]);
        $materieltransports = $this->Commandeclients->Materieltransports->find('list', ['limit' => 200]);
        $bonlivraisons = $this->Commandeclients->Bonlivraisons->find('list', ['limit' => 200]);
        $articles = $this->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'nom']); //->where(["Articles.vente = 1"]);
        $opportunites = $this->Opportunites->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $lignes = $this->Responsableprojets->find('all')->where('Responsableprojets.projet_id =' . $id);
        if ($com != null) {
            $notes = $this->Notes->find('all')->where('Notes.commandeclient_id =' . $com)->first();
        }

        $personnels = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom']);
        $commandefournisseurs = $this->Commandefournisseurs->find('all')->where(['Commandefournisseurs.projet_id =' . $id])->contain(['Fournisseurs'])->group(['Commandefournisseurs.id'])->order(['Commandefournisseurs.id' => 'DESC'])->toArray();
        //$bandeconsultations = $this->fetchTable('Bandeconsultations')->find('all')->where(['Demandeoffredeprixes.projet_id =' . $id])->contain(['Demandeoffredeprixes','Fournisseurs']);
        $bandeconsultations = $this->fetchTable('Bandeconsultations')->find('all')->where(['Demandeoffredeprixes.projet_id =' . $id])->contain(['Fournisseurs', 'Articles', 'Demandeoffredeprixes'])
            ->group(['Demandeoffredeprixes.id'])->order(['Demandeoffredeprixes.id' => 'DESC'])->toArray();

        $clients = $this->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'nom']);
        $fichierpdfs = $this->Pdfs->find('all')->where('Pdfs.projet_id =' . $id);
        $taches = $this->fetchTable('Taches')->find('all')->where('Taches.projet_id =' . $id);

        $tachesss = $this->Taches->find('list', ['keyfield' => 'id', 'valueField' => 'libelle'])->where('Taches.projet_id =' . $id);

        $tacheassign = $this->Tacheassigns->find('all')->where(['Tacheassigns.projet_id' => $project_id])->contain(['Projets', 'Personnels', 'Taches']);
        $tache = $taches->toArray();
        $progressions = $this->fetchTable('Progressions')->find('list', ['keyfield' => 'id', 'valueField' => 'valeur']);
        $listeIdsFactures = [];
        foreach ($facturefournisseurs as $facture) {
            $listeIdsFactures[] = $facture['id'];
        }
        if ($listeIdsFactures != null) {
            $reglementfournisseur = $this->fetchTable('Lignereglements')->find()
                ->where(['Lignereglements.facture_id IN' => $listeIdsFactures])
                ->contain(['Factures', 'Reglements'])
                ->all();
        }
        $listeIdsFacturesClients = [];
        foreach ($factureclients as $facture) {
            $listeIdsFacturesClients[] = $facture['id'];
        }
        if ($listeIdsFacturesClients != null) {
            $reglementclients = $this->fetchTable('Lignereglementclients')->find()
                ->where(['Lignereglementclients.factureclient_id IN' => $listeIdsFacturesClients])
                ->contain(['Factureclients', 'Reglementclients'])
                ->all();
        }
        $tacheprojetall = $this->fetchTable('Tacheprojets')->find('all')->where(['Tacheprojets.projet_id' => $id])->contain(['Personnels', 'Tachedesignations']);
        $tachedesignations = $this->fetchTable('Tachedesignations')->find('list', ['keyfield' => 'id', 'valueField' => 'designation']);
        $incoterms = $this->fetchTable('Incoterms')->find('list', ['keyfield' => 'id', 'valueField' => 'code']);
        // $devises = $this->fetchTable('Devises')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $devises = $this->fetchTable('Devises')->find('list', [
            'keyfield' => 'id',
            'valueField' => function ($d) {
                return $d->name . ' (' . $d->symbole . ')';
            }
        ]);
        $lignesfour = $this->fetchTable('Ligneprojetfournisseurs')->find('all')->where('Ligneprojetfournisseurs.projet_id =' . $project_id);
        $client = $this->fetchTable('Projets')->find()->select('client_id')->where('id =' . $project_id)->first();
        // debug($client);
        $fournisseursids = [];
        foreach ($lignesfour as $ligne) {
            $fournisseursids[] = $ligne->fournisseur_id;
        }
        if ($fournisseursids != null) {
            $fournisseurss = $this->fetchTable('Fournisseurs')->find()
                ->where(['id IN' => $fournisseursids])
                ->all();
        }
        $fournisseurss = $this->fetchTable('Fournisseurs')->find()->all();
        $paiements = $this->Paiements->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $incotermpdfs = $this->fetchTable('Incoterms')->find('list', ['keyfield' => 'id', 'valueField' => 'code']);
        // debug($fournisseursOptions);
        $modetransports = $this->Modetransports->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $unites = $this->fetchTable('Unites')->find('all');
        // debug($articles->toArray());
        $parametretaus = $this->fetchTable('Parametretaus')->find('all')->first();
        $typeremises['1'] = "%";
        $typeremises['2'] = "Valeur";
        $tracemisejours = $this->fetchTable('Tracemisejours')->find('all', ['contain' => ['Users']])->where(['Tracemisejours.model="Projets"', 'Tracemisejours.id_piece=' . $id]);
        $banques = $this->fetchTable('Banques')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $typeconceptions = $this->fetchTable('Typeconceptions')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        if ($commandeclient['banque_id']) {
            $comptesBanks = $this->fetchtable('ComptesBank')->find('all')->where(['ComptesBank.banque_id' => $commandeclient['banque_id']]);
            //debug($comptesBanks->toArray());
        }

        $parametrageproductions = $this->fetchTable('Parametrageproductions')->find();
        $thisprojetconception = $this->fetchTable('Projetconceptions')->find()->where('projet_id=' . $id)->first();
        $thisprojetcommercial = $this->fetchTable('Projetcommercials')->find()->where('projet_id=' . $id)->first();
        $thisprojetfinance = $this->fetchTable('Projetfinances')->find()->where('projet_id=' . $id)->first();
        $projetproductions = $this->fetchTable('Projetproductions')
        ->find()
        ->contain(['Parametrageproductions']) 
        ->where(['projet_id' => $id]);
    

        $this->set(compact('projetproductions', 'thisprojetproduction', 'thisprojetfinance', 'thisprojetcommercial', 'thisprojetconception', 'parametrageproductions', 'typeconceptions', 'typeremises', 'parametretaus', 'comptesBanks', 'banques', 'tracemisejours', 'methodeexpeditions', 'conditionreglements', 'delailivraisons', 'commandeclient', 'com', 'contrats', 'modetransports', 'unites', 'paiements', 'incotermpdfs', 'pays', 'client', 'fournisseurss', 'bandeconsultations', 'mail', 'devises', 'incoterms', 'validation', 'tachedesignations', 'notes', 'tacheprojetall', 'totalReglementAchat', 'totalReglementVente', 'totalMontantVente', 'totalMontantAchat', 'countvente', 'countachat', 'tacheassign', 'assignepar', 'assignea', 'tachesss', 'taches', 'dateAujourdhui', 'reglementclients', 'reglementfournisseur', 'num_dof', 'tache', 'progressions', 'num_commandefournisseur', 'facturefournisseurs', 'c', 'commandefournisseurs', 'listdemandeoffre', 'project_id', 'progress', 'chart_title', 'projets', 'name', 'fournisseurs', 'projets', 'articles', 'formattedDate', 'Projet_name', 'projet_client', 'code', 'tvas', 'projets', 'articles', 'chauffeurs', 'convoyeurs', 'clients', 'pointdeventes', 'depots', 'cartecarburants', 'materieltransports', 'bonlivraisons', 'numero', 'offreggb', 'factureclients', 'commandeclients', 'articles', 'clients', 'projets', 'depots', 'cartecarburants', 'materieltransports', 'chauffeurs', 'convoyeurs', 'bonlivraisons', 'fichierpdfs', 'projet', 'commercials', 'lignes', 'personnels', 'commandefournisseurs', 'clients', 'opportunites'));
    }
    public function saveetat()
    {
        //debug($id);
        // Configure::write('debug', true);
        if ($this->request->is(['patch', 'post', 'put'])) {
            //debug( $this->request->getData());die;
            $id = $this->request->getData('commandeclientid');
            $projet_id = $this->request->getData('projectid');
            $commandeclient = $this->fetchTable('Commandeclients')->get($id, [
                'contain' => ['Lignecommandeclients'],
            ]);
            $commandeclient->activeremise = $this->request->getData('activeremise');
            $commandeclient->activeremisetransport = $this->request->getData('activeremisetransport');
            if ($this->fetchTable('Commandeclients')->save($commandeclient)) {
                debug($commandeclient); //die;
            ?>
                <script>
                    var currentUrl = window.location.href;
                    var parentUrl = currentUrl.split('/').slice(0, -1).join('/');
                    window.location.href = parentUrl + '/vieww/<?php echo $projet_id ?>';
                    var link = parentUrl + "/impfichier/<?php echo $id ?>/<?php echo $projet_id ?>";



                    openWindow(1000, 1000, link);


                    function openWindow(h, w, url) {
                        leftOffset = (screen.width / 2) - w / 2;
                        topOffset = (screen.height / 2) - h / 2;
                        var popup = window.open(url, 'PopupWindow', 'left=' + leftOffset + ',top=' + topOffset + ',width=' + w + ',height=' + h + ',resizable,scrollbars=yes');
                    }
                </script>
            <?php

            }
        }
    }
    public function viewwtest($id = null, $com = null)
    {
        // $com=$this->Session->read('com');
        $session = $this->request->getSession();
        //$com = $session->read('com');
        //var_dump($com);
        $user_id = $this->request->getAttribute('identity')->id;
        $user = $this->fetchTable('Users')->find('all')->where(['Users.id' => $user_id])->first();
        $mail = $user->mail;
        $validation = $user->validation;
        $project_id = $id;
        $typeof = 1;
        $projets = $this->Projets->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $projet = $this->Projets->find()
            ->select(['name'])
            ->where(['id' => $project_id])
            ->first();
        $name = $projet->name;
        $chart_title = "Etat d'avancement du projet " . $name;
        $this->loadModel('Commandeclients');
        $this->loadModel('Pdfs');
        $this->loadModel('Responsableprojets');
        $this->loadModel('Fournisseurs');
        $this->loadModel('Articles');
        $this->loadModel('Commandefournisseurs');
        $this->loadModel('Lignecommandefournisseurs');
        $this->loadModel('Lignedemandeoffredeprixes');
        $this->loadModel('Tacheassigns');
        $this->loadModel('Demandeoffredeprixes');
        $this->loadModel('Personnels');
        $this->loadModel('Clients');
        $this->loadModel('Projets');
        $this->loadModel('Tvas');
        $this->loadModel('Opportunites');
        $this->loadModel('Notes');
        $this->loadModel('Contrats');
        $this->loadModel('Modetransports');
        $this->loadModel('Lignecommandeclients');
        $this->loadModel('Commercials');
        $this->loadModel('Taches');
        $this->loadModel('Paiements');
        $connection = ConnectionManager::get('default');
        //         $bandeconsultationnn =$connection->execute("ALTER TABLE `commandefournisseurs` ADD `pay` VARCHAR(255) NULL");
        // die;

        $query = 'SELECT COUNT(*) AS count FROM factures WHERE projet_id = :projet_id';
        $nbfacturesachat = $connection->execute($query, ['projet_id' => $project_id])->fetchAll('assoc');
        $countachat = $nbfacturesachat[0]['count'];
        $query2 = 'SELECT COUNT(*) AS count FROM factureclients WHERE projet_id = :projet_id';
        $nbfacturesvente = $connection->execute($query2, ['projet_id' => $project_id])->fetchAll('assoc');
        $countvente = $nbfacturesvente[0]['count'];
        $querymontantachat = 'SELECT SUM(ttc) AS total FROM factures WHERE projet_id = :projet_id';
        $totalMontantAchat = $connection->execute($querymontantachat, ['projet_id' => $project_id])->fetch('assoc')['total'];
        $querymontantVente = 'SELECT SUM(totalttc) AS total FROM factureclients WHERE projet_id = :projet_id';
        $totalMontantVente = $connection->execute($querymontantVente, ['projet_id' => $project_id])->fetch('assoc')['total'];
        $queryReglementAchat = 'SELECT SUM(Montant_Regler) AS total FROM factures WHERE projet_id = :projet_id';
        $totalReglementAchat = $connection->execute($queryReglementAchat, ['projet_id' => $project_id])->fetch('assoc')['total'];
        $queryReglementVente = 'SELECT SUM(Montant_Regler) AS total FROM factureclients WHERE projet_id = :projet_id';
        $totalReglementVente = $connection->execute($queryReglementVente, ['projet_id' => $project_id])->fetch('assoc')['total'];
        $projet = $connection->execute('SELECT distinct id FROM projets where id=' . $project_id . ';')->fetchAll('assoc');
        $demande = $connection->execute('SELECT distinct projet_id FROM demandeoffredeprixes where projet_id=' . $project_id . ';')->fetchAll('assoc');
        $commandefournisseurs = $connection->execute('SELECT distinct projet_id FROM commandefournisseurs where projet_id=' . $project_id . ';')->fetchAll('assoc');
        $factures = $connection->execute('SELECT distinct projet_id FROM factures where projet_id=' . $project_id . ';')->fetchAll('assoc');
        $offreggb = $connection->execute('SELECT distinct projet_id FROM commandeclients where projet_id=' . $project_id . ';')->fetchAll('assoc');
        $commandeclients = $connection->execute('SELECT distinct projet_id FROM commandeclients where projet_id=' . $project_id . ' AND commandeclients.valider = 1;')->fetchAll('assoc');
        $factureclients = $connection->execute('SELECT distinct projet_id , Montant_Regler FROM factureclients where projet_id=' . $project_id . ';')->fetchAll('assoc');
        $progress = 0;
        if (!empty($factureclients[0]['Montant_Regler']) && $factureclients[0]['Montant_Regler'] > 0) {
            $progress = 100;
        } elseif (!empty($factureclients[0]['projet_id'])) {
            $progress = 85;
        } elseif (!empty($commandeclients[0]['projet_id'])) {
            $progress = 70;
        } elseif (!empty($offreggb[0]['projet_id'])) {
            $progress = 60;
        } elseif (!empty($factures[0]['projet_id'])) {
            $progress = 45;
        } elseif (!empty($commandefournisseurs[0]['projet_id'])) {
            $progress = 30;
        } elseif (!empty($demande[0]['projet_id'])) {
            $progress = 15;
        } elseif (!empty($projet[0]['id'])) {
            $progress = 5;
        }
        $taches = $this->fetchTable('Taches')->find('all')->where('Taches.projet_id =' . $id);
        $tacheassigns = $this->Tacheassigns->find('all')->where(['Tacheassigns.projet_id' => $project_id])->contain(['Projets', 'Personnels', 'Taches']);
        $tasks = array();
        foreach ($tacheassigns as $ta => $item) {
            $task = array(
                "id" => $item->id,
                "numero" => $item->numero,
            );
            array_push($tasks, $task);
        }
        $json_tasks = json_encode($tasks);
        $num = $this->Demandeoffredeprixes->find()->select(["numdepot" => 'MAX(Demandeoffredeprixes.numero)'])->first();
        $numero = $num->numdepot;
        $n = 0;
        $n = $numero;
        if (!empty($n)) {
            $ff = intval(substr($n, 3, 7)) + 1;
            $z = str_pad("$ff", 5, '0', STR_PAD_LEFT);
            $c = str_pad("$z", 6, 'F', STR_PAD_LEFT);
            $code = str_pad("$c", 7, 'O', STR_PAD_LEFT);
            $num_dof = str_pad("$code", 8, 'D', STR_PAD_LEFT);
        } else {
            $n = "00001";
            $c = str_pad("$n", 6, 'F', STR_PAD_LEFT);
            $code = str_pad("$c", 7, 'O', STR_PAD_LEFT);
            $num_dof = str_pad("$code", 8, 'D', STR_PAD_LEFT);
        }
        $this->set(compact('num_dof'));
        $projet = $this->Projets->newEmptyEntity();
        if ($this->request->is(['patch', 'post', 'put'])) {

            $session = $this->request->getSession();
            $session->write('com', null);

            //debug($this->request->getData());die;

            $fichierpdfexit = $this->Pdfs->find('all')->where('Pdfs.projet_id =' . $id);
            $ligneexistes = $this->Responsableprojets->find('all')->where('Responsableprojets.projet_id =' . $id);
            $lignenotes = $this->Notes->find('all')->where('Notes.projet_id =' . $id);
            foreach ($lignenotes as $n) {
                $this->Notes->delete($n);
            }
            $notes = $this->Notes->newEmptyEntity();
            $data['projet_id'] = $id;
            $data['notepub'] = $this->request->getData('note_publique');
            $data['noteprive'] = $this->request->getData('note_prive');
            $data['user_id'] = $this->request->getData('user_id');
            //debug($this->request->getData('user_id'));
            $notes = $this->Notes->patchEntity($notes, $data);
            $this->Notes->save($notes);
            $this->misejour("Notes", "Add", $id);
            $projet_id = $notes['projet_id'];
            $this->loadModel('Projets');
            $projet = $this->Projets->get($projet_id);
            $datetimeActuelle = FrozenTime::now();
            $datetimeActuelle->format('Y-m-d H:i:s');
            $projet->datemodification = $datetimeActuelle;
            $this->Projets->save($projet);
            foreach ($ligneexistes as $l) {
                $this->Responsableprojets->delete($l);
            }
            if (isset($this->request->getData('data')['ligne']) && (!empty($this->request->getData('data')['ligne']))) {
                foreach ($this->request->getData('data')['ligne'] as $i => $ligne) {
                    if ($ligne['sup1'] != 1) {
                        $responsableprojets = $this->Responsableprojets->newEmptyEntity();
                        $data['projet_id'] = $project_id;
                        $data['personnel_id'] = $ligne['personnel_id'];
                        $responsableprojets = $this->Responsableprojets->patchEntity($responsableprojets, $data);
                        $this->Responsableprojets->save($responsableprojets);
                        $this->misejour("Responsables de projets", "edit", $id);
                        $projet_id = $responsableprojets['projet_id'];
                        $this->loadModel('Projets');
                        $projet = $this->Projets->get($projet_id);
                        $datetimeActuelle = FrozenTime::now();
                        $datetimeActuelle->format('Y-m-d H:i:s');
                        $projet->datemodification = $datetimeActuelle;
                        $this->Projets->save($projet);
                    }
                }
            }
            if (isset($this->request->getData('data')['fichier']) && (!empty($this->request->getData('data')['fichier']))) {
                foreach ($this->request->getData('data')['fichier'] as $i => $exon) {

                    $this->loadModel('Exonerations');
                    if ($exon['sup1'] != 1) {
                        $data['projet_id'] = $project_id;
                        if (isset($exon['id']) && (!empty($exon['id']))) {
                            $fichPdfs = $this->fetchTable('Pdfs')->get($exon['id'], [
                                'contain' => []
                            ]);
                        } else {
                            $fichPdfs = $this->fetchTable('Pdfs')->newEmptyEntity();
                        };
                        $logo = $exon['pdf'];
                        if (!empty($logo)) {
                            $name = $logo->getClientFilename();
                            $targetPath = WWW_ROOT . 'img' . DS . 'logoclients' . DS . $name;
                            if ($name) {
                                $logo->moveTo($targetPath);
                                $data['fichier'] = $name;
                            }
                        }
                        $fichPdfs = $this->fetchTable('Pdfs')->patchEntity($fichPdfs, $data);
                        if ($this->fetchTable('Pdfs')->save($fichPdfs)) {
                            $this->misejour("PDFS", "edit", $id);
                            $projet_id = $fichPdfs['projet_id'];
                            $this->loadModel('Projets');
                            $projet = $this->Projets->get($projet_id);
                            $datetimeActuelle = FrozenTime::now();
                            $datetimeActuelle->format('Y-m-d H:i:s');
                            $projet->datemodification = $datetimeActuelle;
                            $this->Projets->save($projet);
                        } else {
                        }
                    } else {
                        if (!empty($exon['id']))
                            $fichPdfs = $this->fetchTable('Pdfs')->get($exon['id']);
                        $this->fetchTable('Pdfs')->delete($fichPdfs);
                    }
                }
            }
            $this->loadModel('Tacheprojets');
            if (isset($this->request->getData('data')['tacheprojets']) && (!empty($this->request->getData('data')['tacheprojets']))) {
                foreach ($this->request->getData('data')['tacheprojets'] as $i => $tacheprojetData) {
                    $tacheprojetId = $tacheprojetData['id'];
                    $tacheprojet = $this->Tacheprojets->get($tacheprojetId);
                    $data['projet_id'] = $tacheprojetData['projet_id'];
                    $data['tachedesignation_id'] = $tacheprojetData['tachedesignation_id'];
                    $data['datedebut'] = $tacheprojetData['datedebut'];
                    $data['datefin'] = $tacheprojetData['datefin'];
                    $data['etat'] = $tacheprojetData['etat'];
                    $data['personnel_id'] = $tacheprojetData['personnel_id'];
                    $tacheprojet = $this->Tacheprojets->patchEntity($tacheprojet, $data);
                    $this->Tacheprojets->save($tacheprojet);
                }
            }
            $tach['ref'] = $this->request->getData('ref');
            $tach['libelle'] = $this->request->getData('libellee');
            $tach['projet_id'] = $this->request->getData('projet_id');
            $tach['progression_id'] = $this->request->getData('progression_id');
            $tach['dated'] = $this->request->getData('dated');
            $tach['datefin'] = $this->request->getData('datefinn');
            $tach['dated'] = $this->request->getData('dated');
            $tach['datefin'] = $this->request->getData('datefin');
            $tach['description'] = $this->request->getData('descriptionn');
            $tach['contact'] = $this->request->getData('contact');
            $tach['duree'] = $this->request->getData('duree');
            $tach['dureem'] = $this->request->getData('dureem');
            if (!empty($tach['libelle']) || isset($tach['libelle'])) {
                $tacheprojet = $this->fetchTable('Taches')->newEmptyEntity();
                $tacheprojet = $this->fetchTable('Taches')->patchEntity($tacheprojet, $tach);
                $this->fetchTable('Taches')->save($tacheprojet);
            }
            if (isset($this->request->getData('data')['tabletache']) || (!empty($this->request->getData('data')['tabletache']))) {
                foreach ($this->request->getData('data')['tabletache'] as $t => $tache) {
                    $numtache1 = $this->Tacheassigns->find()->select([
                        "numero" =>
                        'MAX(Tacheassigns.numero)'
                    ])->first();
                    $numta1 = $numtache1->numero;
                    if ($numta1 != null) {
                        $numta1 = $numtache1;
                        $lastnum1 = $numta1->numero;
                        $nume1 = intval($lastnum1) + 1;
                        $nn1 = (string) $nume1;
                        $numerotache = str_pad($nn1, 6, "0", STR_PAD_LEFT);
                    } else {
                        $numerotache = "000001";
                    }

                    $tacheassign = $this->Tacheassigns->newEmptyEntity();
                    if ($tache['sup0'] != 1) {
                        $datatache['numero'] = $numerotache;
                        $datatache['projet_id'] = $project_id;
                        $datatache['tache_id'] = $tache['tache_id'];
                        $datatache['personnel_id'] = $tache['commercial_id'];
                        $datatache['datedebut'] = $tache['datedebut'];
                        $datatache['datefin'] = $tache['datefin'];
                        $datatache['HH'] = $tache['HH'];
                        $datatache['MM'] = $tache['MM'];
                        $datatache['note'] = $tache['note'];
                    }
                    $tacheassign = $this->Tacheassigns->patchEntity($tacheassign, $datatache);
                    $this->Tacheassigns->save($tacheassign);
                    $this->misejour("Tache Assign", "Add", $id);
                    $projet_id = $tacheassign['projet_id'];
                    $this->loadModel('Projets');
                    $projet = $this->Projets->get($projet_id);
                    $datetimeActuelle = FrozenTime::now();
                    $datetimeActuelle->format('Y-m-d H:i:s');
                    $projet->datemodification = $datetimeActuelle;
                    $this->Projets->save($projet);
                }
            }
            if (isset($this->request->getData('data')['tabledemandeoffre']) || (!empty($this->request->getData('data')['tabledemandeoffre']))) {
                foreach ($this->request->getData('data')['tabledemandeoffre'] as $d => $dof) {
                    $datadof['numero'] = $dof['numero'];
                    $datadof['date'] = $dof['date'];
                    $datadof['typeoffredeprix'] = $typeof;
                    $datadof['projet_id'] = $project_id;
                    $demandeoffredeprix = $this->Demandeoffredeprixes->newEmptyEntity();
                    $demandeoffredeprix = $this->Demandeoffredeprixes->patchEntity($demandeoffredeprix, $datadof);
                    $this->misejour("Demandeoffredeprixes", "addprojet", $id);
                    $projet_id = $demandeoffredeprix['projet_id'];
                    $this->loadModel('Projets');
                    $projet = $this->Projets->get($projet_id);
                    $datetimeActuelle = FrozenTime::now();
                    $datetimeActuelle->format('Y-m-d H:i:s');
                    $projet->datemodification = $datetimeActuelle;
                    $this->Projets->save($projet);
                }
                if (isset($this->request->getData('data')['lignef']) || (isset($this->request->getData('data')['lignea']))) {
                    // debug(isset($this->request->getData('data')['lignea']));
                    if ($this->Demandeoffredeprixes->save($demandeoffredeprix)) {
                        $demandeoffredeprix_id = ($this->Demandeoffredeprixes->save($demandeoffredeprix)->id);
                        $this->misejour("Demandeoffredeprixes", "add", $demandeoffredeprix_id);
                        $id = $demandeoffredeprix->id;
                        $projet_id = $demandeoffredeprix['projet_id'];
                        $this->loadModel('Projets');
                        $projet = $this->Projets->get($projet_id);
                        $datetimeActuelle = FrozenTime::now();
                        $datetimeActuelle->format('Y-m-d H:i:s');
                        $projet->datemodification = $datetimeActuelle;
                        $this->Projets->save($projet);
                        $session = $this->request->getSession();
                        $tacheeprojet = $this->fetchTable('Tacheprojets')->find('all')->where(['Tacheprojets.projet_id=' . $projet_id, 'Tacheprojets.tachedesignation_id=1'])->first();
                        $tacheeprojet->datedebut = $datetimeActuelle;
                        $tacheeprojet->personnel_id = $session->read('user');;
                        $this->fetchTable('Tacheprojets')->save($tacheeprojet);
                        if (isset($this->request->getData('data')['lignef']) && (!empty($this->request->getData('data')['lignef']))) {
                            foreach ($this->request->getData('data')['lignef'] as $j => $fourni) {
                                // debug($fourni['sup1']);
                                if ($fourni['sup1'] != 1) {
                                    // debug($fourni['sup1']);
                                    if ($fourni['fournisseur_id'] == '') {
                                        $datafourni['name'] = $fourni['nameF'];
                                        $datafourni['mail'] = $fourni['mail'];
                                        $fournisseurs = $this->fetchTable('Fournisseurs')->newEmptyEntity();
                                        $fournisseurs = $this->Fournisseurs->patchEntity($fournisseurs, $datafourni);
                                        if ($this->Fournisseurs->save($fournisseurs)) {

                                            $idfour = $fournisseurs->id;
                                        }
                                    }
                                    if (isset($this->request->getData('data')['lignea']) && (!empty($this->request->getData('data')['lignea']))) {
                                        $this->loadModel('Articles');
                                        debug($this->request->getData('data')['lignea']);
                                        foreach ($this->request->getData('data')['lignea'] as $i => $art) {


                                            if ($art['sup0'] != 1) {
                                                if ($art['article_id']) {
                                                    $ar = $this->Articles->find()->select(["nomarticle" => '(Articles.Dsignation)'])->where(["Articles.id" => $art['article_id']])->first();
                                                    $arr = $ar->nomarticle;
                                                    $art['designiationA'] = $arr;
                                                } else {
                                                    $art['designiationA'] = $art['article_idd'];
                                                }
                                                $data['demandeoffredeprix_id'] = $id;
                                                $data['article_id'] = $art['article_id'];
                                                $data['designiationA'] = $art['designiationA'];
                                                $data['qte'] = $art['qte'];
                                                if ($fourni['fournisseur_id'] == "") {
                                                    $data['fournisseur_id'] = $idfour;
                                                    $data['nameF'] = $fourni['nameF'];
                                                } else {
                                                    $data['fournisseur_id'] = $fourni['fournisseur_id'];
                                                    $free = $this->Fournisseurs->find()->select(["nom" => '(Fournisseurs.name)'])->where(["Fournisseurs.id" => $fourni['fournisseur_id']])->first();
                                                    $data['nameF'] = $free->nom;
                                                }
                                                $data['mail'] = $fourni['mail'];
                                                $demandeoffre = $this->fetchTable('Lignedemandeoffredeprixes')->newEmptyEntity();
                                                $demandeoffre = $this->Lignedemandeoffredeprixes->patchEntity($demandeoffre, $data);

                                                if ($this->Lignedemandeoffredeprixes->save($demandeoffre)) {
                                                    // debug($demandeoffre);
                                                }
                                                $this->set(compact("demandeoffre"));
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
            if (isset($this->request->getData('data')['ligner']) && (isset($this->request->getData('data')['commandefournisseur']))) {
                $commande = $this->fetchTable('Commandefournisseurs')->newEmptyEntity();
                foreach ($this->request->getData('data')['commandefournisseur'] as $i => $cmdfourn) {
                    // $projett = $this->Projets->get($projet_id);
                    // $client_idd = $projet->client_id;
                    // debug($projett);
                    $data['numero'] = $cmdfourn['numero'];
                    $data['date'] = $cmdfourn['date'];
                    $data['fournisseur_id'] = $cmdfourn['fournisseur_id'];
                    $data['projet_id'] = $project_id;
                    $data['tvaOnOff'] = $cmdfourn['tvaOnOff'];
                    $data['depot_id'] = $cmdfourn['depot_id'];
                    $data['conteneur_id'] = $cmdfourn['conteneur_id'];
                    $data['typecommande'] = $typeof;
                    $data['remise'] = $cmdfourn['remise'];
                    $data['tva'] = $cmdfourn['tva'];
                    $data['fodec'] = $cmdfourn['fodec'];
                    $data['ht'] = $cmdfourn['ht'];
                    $data['ttc'] = $cmdfourn['ttc'];
                    $commande = $this->Commandefournisseurs->patchEntity($commande, $data);
                    if ($this->Commandefournisseurs->save($commande)) {
                        // debug($commande);
                        $projet_id = $commande['projet_id'];
                        $this->loadModel('Projets');
                        $projet = $this->Projets->get($projet_id);
                        $datetimeActuelle = FrozenTime::now();
                        $datetimeActuelle->format('Y-m-d H:i:s');
                        $projet->datemodification = $datetimeActuelle;

                        // debug($projet->toArray());
                        // debug($client_idd);
                        $this->Projets->save($projet);
                        $cmd_id = ($this->Commandefournisseurs->save($commande)->id);
                        $this->misejour("Commandefournisseurs", "add", $cmd_id);
                        $commande_id = $commande->id;
                        if (isset($this->request->getData('data')['ligner']) && (!empty($this->request->getData('data')['ligner']))) {
                            $this->loadModel('Commandefournisseurs');
                            foreach ($this->request->getData('data')['ligner'] as $i => $commande) {
                                if ($commande['sup0'] != 1) {
                                    $data['commandefournisseur_id'] = $commande_id;
                                    $data['fournisseur_id'] = $this->request->getData('fournisseur_id');
                                    $data['date'] = date('d-m-y');
                                    $data['qte'] = $commande['qtecmd'];
                                    $data['prix'] = $commande['prixcmd'];
                                    // debug($commande['prixcmd']);die;
                                    $data['ht'] = $commande['punhtcmd'];
                                    $data['article_id'] = $commande['article_id'];
                                    $data['remise'] = $commande['remisecmd'];
                                    $data['fodec'] = $commande['fodeccmd'];
                                    $data['tva'] = $commande['tvacmd'];
                                    $data['ttc'] = $commande['ttccmd'];
                                    $cd = $this->fetchTable('Lignecommandefournisseurs')->newEmptyEntity();
                                    $cd = $this->Lignecommandefournisseurs->patchEntity($cd, $data);
                                    if ($this->Lignecommandefournisseurs->save($cd)) {
                                        // debug($cd);
                                    } else {
                                    }
                                    $this->set(compact("cd"));
                                }
                            }
                        }
                    }
                }
            }
            if ((isset($this->request->getData('data')['tablecommandeclient']) && (!empty($this->request->getData('data')['tablecommandeclient']))) && (isset($this->request->getData('data')['tablecommandeclientedit']) && (!empty($this->request->getData('data')['tablecommandeclientedit'])))) {

                if ($this->request->getData('data')['tablecommandeclient'][0]['id'] == "") {
                    foreach ($this->request->getData('data')['tablecommandeclient'] as $i => $commandecl) {

                        $datacomm['modetransport_id'] = (int) $commandecl['modetransport_id'];
                        $datacomm['code'] = $commandecl['code'];
                        $datacomm['tvaOnOff'] = $commandecl['tvaOnOff'];
                        $datacomm['client_id'] = $commandecl['client_id'];
                        $datacomm['depot_id'] = $commandecl['depot_id'];
                        $datacomm['datedecreation'] = $commandecl['datedecreation'];
                        $datacomm['commentaire'] = $commandecl['commentaire'];
                        $datacomm['date'] = $commandecl['date'];
                        $datacomm['duree_validite'] = $commandecl['duree_validite'];
                        $datacomm['incoterm_id'] = $commandecl['incoterm_id'];
                        $datacomm['incotermpdf_id'] = $commandecl['incotermpdf_id'];
                        $datacomm['devis_id'] = $commandecl['devis_id'];
                        $datacomm['pay'] = $commandecl['pay'];
                        $datacomm['devis2_id'] = $commandecl['devis2_id'];
                        $datacomm['tauxdechange'] = $commandecl['tauxdechange'];
                        $datacomm['tauxdechange2'] = $commandecl['tauxdechange2'];
                        $datacomm['detailtransport'] = (int) $commandecl['detailtransport'];
                        $datacomm['nbfergule'] = (int) $commandecl['nbfergule'];
                        $datacomm['remisetotal'] = (int) $commandecl['remisetotal'];
                        $datacomm['datelivraison'] = $commandecl['datelivraison'];
                        $datacomm['methodeexpedition_id'] = (int) $commandecl['methodeexpedition_id'];
                        $datacomm['delailivraison_id'] = (int) $commandecl['delailivraison_id'];
                        $datacomm['conditionreglement_id'] = (int) $commandecl['conditionreglement_id'];


                        $commandeclient = $this->Commandeclients->newEmptyEntity();
                        $commandeclient->projet_id = $id;
                        $commandeclient = $this->Commandeclients->patchEntity($commandeclient, $datacomm);

                        if ($this->Commandeclients->save($commandeclient)) {
                            //debug($commandeclient);die;
                            foreach ($commandecl['paiement_id'] as $key => $paicom) {
                                $clientpaiement = $this->fetchTable('Clientpaiements')->newEmptyEntity();
                                $dattc['paiement_id'] = $paicom;
                                $dattc['commandeclient_id'] = $commandeclient->id;
                                $clientpaiement = $this->fetchTable('Clientpaiements')->patchEntity($clientpaiement, $dattc);
                                $this->fetchTable('Clientpaiements')->save($clientpaiement);
                            }
                            $this->misejour("Offre ggb", "add", $id);
                            $projet_id = $commandeclient['projet_id'];
                            $this->loadModel('Projets');
                            $projet = $this->Projets->get($projet_id);
                            $datetimeActuelle = FrozenTime::now();
                            $datetimeActuelle->format('Y-m-d H:i:s');
                            $projet->datemodification = $datetimeActuelle;
                            $this->Projets->save($projet);
                            $commandeclient_id = $commandeclient->id;
                        }
                    }
                    $session = $this->request->getSession();
                    $session->write('com', $commandeclient_id);
                    return $this->redirect(['action' => 'vieww/' . $project_id . '/' . $commandeclient_id]);
                } else {
                    //debug('ggggg');
                    //die;
                    $commandeclient = $this->Commandeclients->get($this->request->getData('data')['tablecommandeclientedit']['id'], [
                        'contain' => ['Lignecommandeclients'],
                    ]);
                    $datacomm['id'] = $this->request->getData('data')['tablecommandeclientedit']['id'];

                    $datacomm['totalmarge'] = $this->request->getData('data')['tablecommandeclientedit']['totalmarge'];
                    $datacomm['totalht'] = $this->request->getData('data')['tablecommandeclientedit']['totalht'];
                    $datacomm['totaltva'] = $this->request->getData('data')['tablecommandeclientedit']['totaltva'];
                    $datacomm['totalremise'] = $this->request->getData('data')['tablecommandeclientedit']['totalremise'];
                    $datacomm['totalttc'] = $this->request->getData('data')['tablecommandeclientedit']['totalttc'];
                    $datacomm['totalttcdl'] = $this->request->getData('data')['tablecommandeclientedit']['totalttcdl'];
                    $datacomm['totalfodec'] = $this->request->getData('data')['tablecommandeclientedit']['totalfodec'];
                    $commandeclient = $this->Commandeclients->patchEntity($commandeclient, $datacomm);
                    if ($this->Commandeclients->save($commandeclient)) {
                        $this->misejour("Offre ggb", "edit", $this->request->getData('data')['tablecommandeclientedit']['id']);
                        $projet_id = $commandeclient['projet_id'];
                        $this->loadModel('Projets');
                        $projet = $this->Projets->get($projet_id);
                        $datetimeActuelle = FrozenTime::now();
                        $datetimeActuelle->format('Y-m-d H:i:s');
                        $projet->datemodification = $datetimeActuelle;
                        $this->Projets->save($projet);

                        if (isset($this->request->getData('data')['lignecommandeclientsedit']) && (!empty($this->request->getData('data')['lignecommandeclientsedit']))) {
                            foreach ($this->request->getData('data')['lignecommandeclientsedit'] as $i => $res) {
                                if ($res['sup0'] != 1) {
                                    $dat['fournisseur_id'] = $res['fournisseur_id'];
                                    $dat['article_id'] = $res['article_id'];
                                    $dat['unite_id'] = $res['unite_id'];
                                    $dat['qte'] = $res['qte'];
                                    $dat['tauxdemarge'] = $res['tauxdemarge'];
                                    $dat['tauxdemarque'] = $res['tauxdemarque'];
                                    $dat['description'] = $res['description'];
                                    $dat['coutrevient'] = $res['coutrevient'];
                                    $dat['prixht'] = $res['prixht'];
                                    $dat['remise'] = $res['remise'];
                                    $dat['punht'] = $res['punht'];
                                    $dat['tva'] = $res['tva'];
                                    $dat['fodec'] = $res['fodec'];
                                    $dat['ttc'] = $res['ttc'];
                                    $dat['type'] = $res['type'];
                                    $dat['commandeclient_id'] = $this->request->getData('data')['tablecommandeclientedit']['id'];
                                    $lignecommandeclient = $this->fetchTable('lignecommandeclients')->newEmptyEntity();

                                    $lignecommandeclient = $this->fetchTable('lignecommandeclients')->patchEntity($lignecommandeclient, $dat);
                                    //$this->fetchTable('lignecommandeclients')->save($lignecommandeclient);
                                    //  debug($lignecommandeclient);die;

                                    if ($this->fetchTable('lignecommandeclients')->save($lignecommandeclient)) {
                                    }
                                }
                                $this->set(compact("lignecommandeclient"));
                            }
                        }
                    }
                    $session = $this->request->getSession();
                    $com = $session->write('com', null);
                    return $this->redirect(['action' => 'vieww/', $project_id]);
                }
            }
            return $this->redirect(['action' => 'vieww/' . $project_id]);
        }
        $this->loadModel('Commandeclients');
        $this->loadModel('Personnels');
        if ($com != null) {
            $commandeclient = $this->Commandeclients->get($com, [
                'contain' => ['Lignecommandeclients'],
            ]);

            $this->loadModel('Clients');
            $this->loadModel('Projets');
            $projets = $this->fetchTable('Projets')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
            $clients = $this->fetchTable('Clients')->find('list', ['keyfield' => 'id', 'valueField' => 'nom']);
            $chauffeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 5 . "%' "]);
            $convoyeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 1 . "%' "]);
            $pointdeventes = $this->Commandeclients->Pointdeventes->find('list', ['limit' => 200]);
            $depots = $this->Commandeclients->Depots->find('list', ['limit' => 200]);
            $cartecarburants = $this->Commandeclients->Cartecarburants->find('list', ['limit' => 200]);
            $materieltransports = $this->Commandeclients->Materieltransports->find('list', ['limit' => 200]);
            $bonlivraisons = $this->Commandeclients->Bonlivraisons->find('list', ['limit' => 200]);
            $this->loadModel('Lignecommandeclients');
            // $lignecommandeclients = $this->Commandeclients->Lignecommandeclients->find('all')->where(["Lignecommandeclients.commandeclient_id=" . $id . " "])->ToArray();
            // debug($id);
            $connection = ConnectionManager::get('default');
            $lignecommandeclients = $connection->execute("SELECT lc.* FROM lignecommandeclients lc INNER JOIN ( SELECT article_id, MAX(prixht) AS max_price FROM lignecommandeclients WHERE commandeclient_id='" . $com . "' GROUP BY article_id) AS max_prices ON lc.article_id = max_prices.article_id AND lc.prixht = max_prices.max_price WHERE lc.commandeclient_id='" . $com . "'")->fetchAll('assoc');
            //debug($commandeclient);

            $this->loadModel('Articles');
            $articles = $this->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Articles.typearticle = 1"]);
            $articleservices = $this->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Articles.typearticle = 2"]);
            // $devises = $this->fetchTable('Devises')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
            $devises = $this->fetchTable('Devises')->find('list', [
                'keyfield' => 'id',
                'valueField' => function ($d) {
                    return $d->name . ' (' . $d->symbole . ')';
                }
            ]);
            $incoterms = $this->fetchTable('Incoterms')->find('list', ['keyfield' => 'id', 'valueField' => 'code']);
            $connection = ConnectionManager::get('default');
            $code = '-1';

            if ($commandeclient['devis_id']) {
                $devise = $connection->execute("SELECT code FROM devises WHERE id='" . $commandeclient['devis_id'] . "'")->fetch('assoc');
                // debug($devise);die;
                $code = $devise['code'];
            }
            $incotermpdfs = $this->fetchTable('Incoterms')->find('list', ['keyfield' => 'id', 'valueField' => 'code']);
            $this->loadModel('Paiements');
            $paiements = $this->Paiements->find('list', ['keyfield' => 'id', 'valueField' => 'name']);


            if ($commandeclient['paiement_id']) {
                $gg = explode(" ", $commandeclient['paiement_id']);
            }

            $Clientpaiement = $this->fetchTable('Clientpaiements')->find('all')->where('Clientpaiements.commandeclient_id =' . $com);
            $gg = [];
            foreach ($Clientpaiement as $itemm) {

                array_push($gg, $itemm['paiement_id']);
            }
            $pays = $this->fetchTable('Pays')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
            //debug($gg) ;
            $modetransports = $this->fetchTable('Modetransports')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
            // debug($lignecommandeclients);die;
            $unites = $this->fetchTable('Unites')->find('all');
            //debug($articles->toArray());
            $fournisseurs = $this->Demandeoffredeprixes->Fournisseurs->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
            $conditionreglements = $this->fetchTable('Conditionreglements')->find('list', ['keyfield' => 'id', 'valueField' => 'conditionn']);
            $delailivraisons = $this->fetchTable('Delailivraisons')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
            $methodeexpeditions = $this->fetchTable('Methodeexpeditions')->find('list', ['keyfield' => 'id', 'valueField' => 'methode']);

            $this->set(compact('methodeexpeditions', 'delailivraisons', 'conditionreglements', 'articleservices', 'fournisseurs', 'unites', 'project_id', 'gg', 'modetransports', 'pays', 'paiements', 'incotermpdfs', 'devises', 'incoterms', 'code', 'lignecommandeclients', 'articles', 'commandeclient', 'clients', 'projets', 'depots', 'cartecarburants', 'materieltransports', 'chauffeurs', 'convoyeurs', 'bonlivraisons'));
        }
        $conditionreglements = $this->fetchTable('Conditionreglements')->find('list', ['keyfield' => 'id', 'valueField' => 'conditionn']);
        $delailivraisons = $this->fetchTable('Delailivraisons')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $methodeexpeditions = $this->fetchTable('Methodeexpeditions')->find('list', ['keyfield' => 'id', 'valueField' => 'methode']);
        $projets = $this->fetchTable('Projets')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $pays = $this->fetchTable('Pays')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $fournisseurs = $this->Demandeoffredeprixes->Fournisseurs->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $articles = $this->Demandeoffredeprixes->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])
            ->where(["Articles.vente = 1"]);

        $num = $this->Commandefournisseurs->find()->select([
            "numdepot" =>
            'MAX(Commandefournisseurs.numero)'
        ])->first();
        $numero = $num->numdepot;
        $n = 0;
        $n = $numero;
        if (!empty($n)) {
            $ff = intval(substr($n, 3, 7)) + 1;
            $z = str_pad("$ff", 5, '0', STR_PAD_LEFT);
            $num_commandefournisseur = str_pad("$z", 6, 'C', STR_PAD_LEFT);
        } else {
            $n = "C00001";
            $z = str_pad(" $n", 5, '0', STR_PAD_LEFT);
            $num_commandefournisseur = str_pad("$z", 6, 'C', STR_PAD_LEFT);
        }
        $client_id_result = $this->Projets->find('all', [
            'fields' => ['Projets.client_id'],
            'conditions' => ['Projets.id' => $id],
        ]);
        $client_id = $client_id_result->first()->client_id;
        if ($client_id != 0) {
            $projet_client = $this->Clients->find()
                ->select(['Raison_Sociale'])
                ->where(["Clients.id" => $client_id])
                ->first();
        }
        $Projet_name = $this->Projets->find()
            ->select(['name'])
            ->where(["Projets.id" => $id])
            ->first();
        $numeroobj = $this->Commandeclients->find()->select([
            "numerox" =>
            'MAX(Commandeclients.code)'
        ])->first();
        $numero = $numeroobj->numerox;
        if ($numero != null) {
            $n = $numero;
            $lastnum = $n;
            $nume = intval($lastnum) + 1;
            $nn = (string) $nume;
            $code = str_pad($nn, 6, "0", STR_PAD_LEFT);
        } else {
            $code = "000001";
        }

        $projet = $this->Projets->get($id, [
            'contain' => (['Clients', 'Opportunites', 'Personnels']),
        ]);;
        $query = $this->Contrats->find('all')->where(['Contrats.projet_id' => $id]);

        $this->paginate = ['contain' => ['Projets', 'Clients', 'Personnels'],];
        $contrats = $this->paginate($query);
        $currentDate = new \DateTime();
        $formattedDate = $currentDate->format('Y-m-d');
        $date = new FrozenTime('now', 'Africa/Tunis');
        $dateAujourdhui = $date->i18nFormat('dd/MM/yyyy HH:mm:ss');
        $assignepar = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 9 . "%' "]);
        $assignea = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id !=  '%" . 9 . "%' "]);
        $chauffeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 5 . "%' "]);
        $convoyeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 1 . "%' "]);
        $tvas = $this->fetchTable('Tvas')->find('list', ['keyfield' => 'id', 'valueField' => 'valeur']);
        $projets = $this->fetchTable('Projets')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $clients = $this->fetchTable('Clients')->find('list', ['keyfield' => 'id', 'valueField' => 'nom']);
        $pointdeventes = $this->Commandeclients->Pointdeventes->find('list', ['limit' => 200]);
        $depots = $this->Commandeclients->Depots->find('list', ['limit' => 200]);
        $cartecarburants = $this->Commandeclients->Cartecarburants->find('list', ['limit' => 200]);
        $materieltransports = $this->Commandeclients->Materieltransports->find('list', ['limit' => 200]);
        $bonlivraisons = $this->Commandeclients->Bonlivraisons->find('list', ['limit' => 200]);
        $articles = $this->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'nom']); //->where(["Articles.vente = 1"]);
        $commandefournisseurs = $this->fetchTable('Commandefournisseurs')->find()->where(['Commandefournisseurs.projet_id' => $id])->order(['Commandefournisseurs.id' => 'desc'])->all();
        // debug($commandefournisseurs);
        $facturefournisseurs = $this->fetchTable('Factures')->find('all')->where(['Factures.projet_id' => $id])->group(['Factures.id'])->order(['Factures.id' => 'DESC'])->toArray();
        $commercials = $this->Personnels->find('list', ['keyField' => 'id', 'valueField' => 'nom'])->where(['fonction_id' => 9]);
        $offreggb = $this->fetchTable('Commandeclients')->find('all')->where(['Commandeclients.projet_id' => $id])->contain(['Clients'])->group(['Commandeclients.id'])->order(['Commandeclients.id' => 'DESC'])->toArray();
        $listdemandeoffre = $this->fetchTable('Demandeoffredeprixes')->find('all')->where(['Demandeoffredeprixes.projet_id' => $id])->group(['Demandeoffredeprixes.id'])->order(['Demandeoffredeprixes.id' => 'DESC'])->toArray();
        $commandeclients = $this->fetchTable('Commandeclients')->find()->where(['Commandeclients.projet_id' => $id, 'Commandeclients.valider' => 1])->contain(['Clients'])->all();
        $factureclients = $this->fetchTable('Factureclients')->find('all')->where(['Factureclients.projet_id' => $id])->group(['Factureclients.id'])->order(['Factureclients.id' => 'DESC'])->toArray();
        $projets = $this->fetchTable('Projets')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $clients = $this->fetchTable('Clients')->find('list', ['keyfield' => 'id', 'valueField' => 'nom']);
        $chauffeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 5 . "%' "]);
        $convoyeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 1 . "%' "]);
        $pointdeventes = $this->Commandeclients->Pointdeventes->find('list', ['limit' => 200]);
        $depots = $this->Commandeclients->Depots->find('list', ['limit' => 200]);
        $cartecarburants = $this->Commandeclients->Cartecarburants->find('list', ['limit' => 200]);
        $materieltransports = $this->Commandeclients->Materieltransports->find('list', ['limit' => 200]);
        $bonlivraisons = $this->Commandeclients->Bonlivraisons->find('list', ['limit' => 200]);
        $articles = $this->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'nom']); //->where(["Articles.vente = 1"]);
        $opportunites = $this->Opportunites->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $lignes = $this->Responsableprojets->find('all')->where('Responsableprojets.projet_id =' . $id);
        $notes = $this->Notes->find('all')->where('Notes.projet_id =' . $id)->first();

        $personnels = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom']);
        $commandefournisseurs = $this->Commandefournisseurs->find('all')->where(['Commandefournisseurs.projet_id =' . $id])->contain(['Fournisseurs'])->group(['Commandefournisseurs.id'])->order(['Commandefournisseurs.id' => 'DESC'])->toArray();
        //$bandeconsultations = $this->fetchTable('Bandeconsultations')->find('all')->where(['Demandeoffredeprixes.projet_id =' . $id])->contain(['Demandeoffredeprixes','Fournisseurs']);
        $bandeconsultations = $this->fetchTable('Bandeconsultations')->find('all')->where(['Demandeoffredeprixes.projet_id =' . $id])->contain(['Fournisseurs', 'Articles', 'Demandeoffredeprixes'])
            ->group(['Demandeoffredeprixes.id'])->order(['Demandeoffredeprixes.id' => 'DESC'])->toArray();

        $clients = $this->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'nom']);
        $fichierpdfs = $this->Pdfs->find('all')->where('Pdfs.projet_id =' . $id);
        $taches = $this->fetchTable('Taches')->find('all')->where('Taches.projet_id =' . $id);

        $tachesss = $this->Taches->find('list', ['keyfield' => 'id', 'valueField' => 'libelle'])->where('Taches.projet_id =' . $id);

        $tacheassign = $this->Tacheassigns->find('all')->where(['Tacheassigns.projet_id' => $project_id])->contain(['Projets', 'Personnels', 'Taches']);
        $tache = $taches->toArray();
        $progressions = $this->fetchTable('Progressions')->find('list', ['keyfield' => 'id', 'valueField' => 'valeur']);
        $listeIdsFactures = [];
        foreach ($facturefournisseurs as $facture) {
            $listeIdsFactures[] = $facture['id'];
        }
        if ($listeIdsFactures != null) {
            $reglementfournisseur = $this->fetchTable('Lignereglements')->find()
                ->where(['Lignereglements.facture_id IN' => $listeIdsFactures])
                ->contain(['Factures', 'Reglements'])
                ->all();
        }
        $listeIdsFacturesClients = [];
        foreach ($factureclients as $facture) {
            $listeIdsFacturesClients[] = $facture['id'];
        }
        if ($listeIdsFacturesClients != null) {
            $reglementclients = $this->fetchTable('Lignereglementclients')->find()
                ->where(['Lignereglementclients.factureclient_id IN' => $listeIdsFacturesClients])
                ->contain(['Factureclients', 'Reglementclients'])
                ->all();
        }
        $tacheprojetall = $this->fetchTable('Tacheprojets')->find('all')->where(['Tacheprojets.projet_id' => $id])->contain(['Personnels', 'Tachedesignations']);
        $tachedesignations = $this->fetchTable('Tachedesignations')->find('list', ['keyfield' => 'id', 'valueField' => 'designation']);
        $incoterms = $this->fetchTable('Incoterms')->find('list', ['keyfield' => 'id', 'valueField' => 'code']);
        // $devises = $this->fetchTable('Devises')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $devises = $this->fetchTable('Devises')->find('list', [
            'keyfield' => 'id',
            'valueField' => function ($d) {
                return $d->name . ' (' . $d->symbole . ')';
            }
        ]);
        $lignesfour = $this->fetchTable('Ligneprojetfournisseurs')->find('all')->where('Ligneprojetfournisseurs.projet_id =' . $project_id);
        $client = $this->fetchTable('Projets')->find()->select('client_id')->where('id =' . $project_id)->first();
        // debug($client);
        $fournisseursids = [];
        foreach ($lignesfour as $ligne) {
            $fournisseursids[] = $ligne->fournisseur_id;
        }
        if ($fournisseursids != null) {
            $fournisseurss = $this->fetchTable('Fournisseurs')->find()
                ->where(['id IN' => $fournisseursids])
                ->all();
        }
        $fournisseurss = $this->fetchTable('Fournisseurs')->find()->all();
        $paiements = $this->Paiements->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $incotermpdfs = $this->fetchTable('Incoterms')->find('list', ['keyfield' => 'id', 'valueField' => 'code']);
        // debug($fournisseursOptions);
        $modetransports = $this->Modetransports->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $unites = $this->fetchTable('Unites')->find('all');
        // debug($articles->toArray());
        $this->set(compact('methodeexpeditions', 'conditionreglements', 'delailivraisons', 'commandeclient', 'com', 'contrats', 'modetransports', 'unites', 'paiements', 'incotermpdfs', 'pays', 'client', 'fournisseurss', 'bandeconsultations', 'mail', 'devises', 'incoterms', 'validation', 'tachedesignations', 'notes', 'tacheprojetall', 'totalReglementAchat', 'totalReglementVente', 'totalMontantVente', 'totalMontantAchat', 'countvente', 'countachat', 'tacheassign', 'assignepar', 'assignea', 'tachesss', 'taches', 'dateAujourdhui', 'reglementclients', 'reglementfournisseur', 'num_dof', 'tache', 'progressions', 'num_commandefournisseur', 'facturefournisseurs', 'c', 'commandefournisseurs', 'listdemandeoffre', 'project_id', 'progress', 'chart_title', 'projets', 'name', 'fournisseurs', 'projets', 'articles', 'formattedDate', 'Projet_name', 'projet_client', 'code', 'tvas', 'projets', 'articles', 'chauffeurs', 'convoyeurs', 'clients', 'pointdeventes', 'depots', 'cartecarburants', 'materieltransports', 'bonlivraisons', 'numero', 'offreggb', 'factureclients', 'commandeclients', 'articles', 'clients', 'projets', 'depots', 'cartecarburants', 'materieltransports', 'chauffeurs', 'convoyeurs', 'bonlivraisons', 'fichierpdfs', 'projet', 'commercials', 'lignes', 'personnels', 'commandefournisseurs', 'clients', 'opportunites'));
    }
    public function getcategorie()
    {
        $id = $this->request->getQuery('id');
        $index = $this->request->getQuery('index');
        $index = intval($index) + 1;
        $select = '';
        $query = $this->fetchTable('Articles')->find('all')->where(['Articles.typearticle =' . $id]);
        $select = "
                <select  table='lignea' name='data[lignea][" . $index . "][article_id]' id='article_id" . $index . "' champ='article_id' class= 'form-control select2'>
                <option value='' selected >Veuillez Choisir !!!   </option>";
        foreach ($query as $q) {
            $select = $select . "  <option value ='" . $q['id'] . "'";
            $select = $select . " > " . $q['Dsignation'] . " " . $q['Description'] . "</option>";
        }
        $select = $select . "</select>  ";
        echo json_encode(array('select' => $select));
        exit;
    }
    public function getcategorieoffrggb()
    {
        $id = $this->request->getQuery('id');
        $index = $this->request->getQuery('index');
        $tagfours = $this->Tagsfour->find('all')->where(['Tagsfour.fournisseurs_id' => $id])->contain('Listetags');
        $gg = [];
        foreach ($tagfours as $i => $g) {
            array_push($gg, $g['categorie_id']);
        }
        $idcat = explode(",", $gg);
        $frs = $this->fetchTable('Fournisseurs')->find('all')->where(['Fournisseurs.id =' . $id])->first();
        if ($frs['']) {
            $query = $this->fetchTable('Articles')->find('all')->where(['Articles.typearticle =' . $id]);
        }
        $select = '';

        $select = "
                <select style='text-align:right' table='tabligne3' name='data[tabligne3][" . $index . "][article_id]' id='article_id' champ='article_id' class= 'form-control select2'>
                <option value='' selected >Veuillez Choisir !!!   </option>";
        foreach ($query as $q) {
            $select = $select . "  <option value ='" . $q['id'] . "'";
            $select = $select . " > " . $q['Dsignation'] . " " . $q['Description'] . "</option>";
        }
        $select = $select . "</select> ";
        echo json_encode(array('select' => $select));
        exit;
    }
    public function edittacheprojet($tacheprojet_id = null)
    {
        $this->loadModel('Tacheprojets');
        $tacheprojet = $this->Tacheprojets->get($tacheprojet_id, [
            'contain' => ['Tachedesignations'],
        ]);

        $projet_id = $tacheprojet->projet_id;
        $projet = $this->fetchTable('Projets')->find('all')->where(['Projets.id' => $projet_id])->contain('Clients')->first();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $tacheprojet = $this->Tacheprojets->patchEntity($tacheprojet, $this->request->getData());
            if ($this->Tacheprojets->save($tacheprojet)) {
                return $this->redirect(['action' => 'index']);
            }
        }
        $tachedesignations = $this->fetchTable('Tachedesignations')->find('list', ['keyfield' => 'id', 'valueField' => 'designation']);
        $personnels = $this->fetchTable('Personnels')->find('list', [
            'keyfield' => 'id',
            'valueField' => function ($personnel) {
                return $personnel->nom . ' (' . $personnel->prenom . ') ';
            }
        ]);
        $projets = $this->fetchTable('Projets')->find('list', ['keyfield' => 'id', 'valueField' => 'libelle']);
        $this->set(compact('tacheprojet', 'projets', 'projet', 'projet_id', 'tachedesignations', 'personnels'));
    }

    public function addcateg()
    {
        $this->loadModel('Categories');
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_parametrage' . $abrv);
        $categorie = 0;
        foreach ($liendd as $k => $liens) {
            if (@$liens['lien'] == 'categories') {
                $categorie = $liens['ajout'];
            }
        }
        if (($categorie <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $category = $this->Categories->newEmptyEntity();
        if ($this->request->is('post')) {
            $category = $this->Categories->patchEntity($category, $this->request->getData());
            if ($this->Categories->save($category)) {
                $category_id = ($this->Categories->save($category)->id);
                $this->misejour("Categories", "add", $category_id);
                $id = $category->id;
                $category = $this->Categories->query('SELECT categories.id id, categories.name name from categories');
                //$select = "<select   name='data[Articles][categorie_id]' class='form-control'  champ='categorie_id' id='categorie_id' style = 'text-align:right'>";
                $select = "<option value=''></option>";
                foreach ($category as $f) {
                    if ($f['id'] == $id) {
                        $selected = "selected";
                    } else {
                        $selected = "";
                    }
                    $select = $select . "<option value=" . $f['id'] . " " . $selected . " >" . $f['name'] . " </option>";
                }
                //$select = $select . '</select>';
            ?>
                <script language="javascript">
                    window.opener.document.getElementById('categorie_id').innerHTML = `<?php echo $select; ?>`;
                </script>
                <script language="javascript">
                    window.close();
                </script>
                <!-- <script>     window.opener.document.getElementById('categorie-id').innerHTML = `<?php echo $select; ?>`;     window.close();
                </script> -->
            <?php
            }
        }
        $this->set(compact('category'));
    }
    public function addunite()
    {
        $this->loadModel('Unites');
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_parametrage' . $abrv);
        $unite = 0;
        foreach ($liendd as $k => $liens) {
            if (@$liens['lien'] == 'unite') {
                $unite = $liens['ajout'];
            }
        }
        if (($unite <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $unite = $this->Unites->newEmptyEntity();
        if ($this->request->is('post')) {
            $unite = $this->Unites->patchEntity($unite, $this->request->getData());
            if ($this->Unites->save($unite)) {
                $unite_id = ($this->Unites->save($unite)->id);
                $this->misejour("Unites", "add", $unite_id);
                $id = $unite->id;
                $unite = $this->Unites->query('SELECT unites.id id, unites.name name from unites');
                $select = "<select   name='data[Articles][Unite]' class='form-control'  champ='Unite' id='Unite' style = 'text-align:right'>";
                $select = $select . "<option value=''></option>";
                foreach ($unite as $f) {
                    if ($f['id'] == $id) {
                        $selected = "selected";
                    } else {
                        $selected = "";
                    }
                    $select = $select . "<option value=" . $f['id'] . " " . $selected . " >" . $f['name'] . " </option>";
                }
                $select = $select . '</select>';
            ?>
                <script>
                    window.opener.document.getElementById('unite').innerHTML = `<?php echo $select; ?>`;
                    window.close();
                </script>
            <?php
            }
        }
        $this->set(compact('unite'));
    }

    public function addsouscateg()
    {
        $this->loadModel('Souscategories'); // Load the PaysTable

        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_parametrage' . $abrv);
        $souscategorie = 0;
        foreach ($liendd as $k => $liens) {
            if (@$liens['lien'] == 'souscategories') {
                $souscategorie = $liens['ajout'];
            }
        }
        if (($souscategorie <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $souscategory = $this->Souscategories->newEmptyEntity();
        if ($this->request->is('post')) {
            $souscategory = $this->Souscategories->patchEntity($souscategory, $this->request->getData());
            if ($this->Souscategories->save($souscategory)) {
                $id = $souscategory->id;
                $souscategory = $this->Souscategories->query('SELECT souscategories.id id, souscategories.name name from souscategories');
                $select = "<select   name='data[Articles][souscategorie-id]' class='form-control'  champ='souscategorie-id' id='souscategorie-id' style = 'text-align:right'>";
                $select = $select . "<option value=''></option>";
                foreach ($souscategory as $f) {
                    if ($f['id'] == $id) {
                        $selected = "selected";
                    } else {
                        $selected = "";
                    }
                    $select = $select . "<option value=" . $f['id'] . " " . $selected . " >" . $f['name'] . " </option>";
                }
                $select = $select . '</select>';
            ?>
                <script>
                    window.opener.document.getElementById('souscategorie-id').innerHTML = `<?php echo $select; ?>`;
                    window.close();
                </script>
            <?php
            }
        }
        $this->loadModel('Categories');
        $categories = $this->fetchTable('Categories')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $this->set(compact('souscategory', 'categories'));
    }
    public function addpays()
    {
        $this->loadModel('Pays');
        $pay = $this->Pays->newEmptyEntity();
        if ($this->request->is('post')) {
            $pay = $this->Pays->patchEntity($pay, $this->request->getData());
            if ($this->Pays->save($pay)) {
                $pay_id = $pay->id;
                $this->misejour("Pays", "add", $pay_id);
                $id = $pay->id;
                $pays = $this->Pays->query('SELECT pays.id id, pays.name name from pays');
                $select = "<select   name='data[Articles][pay_id]' class='form-control'  champ='pay_id' id='pay_id' style = 'text-align:right'>";
                $select = $select . "<option value=''></option>";
                foreach ($pays as $f) {
                    if ($f['id'] == $id) {
                        $selected = "selected";
                    } else {
                        $selected = "";
                    }
                    $select = $select . "<option value=" . $f['id'] . " " . $selected . " >" . $f['name'] . " </option>";
                }
                $select = $select . '</select>';
            ?>
                <script>
                    window.opener.document.getElementById('pay_id').innerHTML = `<?php echo $select; ?>`;
                    window.close();
                </script>
            <?php
            }
        }
        $this->set(compact('pay'));
    }
    public function getHeureMinute()
    {
        if ($this->request->is('ajax')) {
            $tache_id = $_GET['tache_id'];
            $ligne = $this->fetchTable('Taches')->find('all')->where(["Taches.id  ='" . $tache_id . "'"]);

            foreach ($ligne as $li) {
                $heure = $li['duree'];
            }
            foreach ($ligne as $li) {
                $minute = $li['dureem'];
            }
            echo json_encode(array("heure" => $heure, "minute" => $minute, "success" => true));
            exit;
        }
        $this->loadModel('Articles');
        die;
    }
    public function addtache($index = null, $project_id = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_projet' . $abrv);
        $tache = 0;
        foreach ($liendd as $k => $liens) {
            if (@$liens['lien'] == 'taches') {
                $tache = $liens['ajout'];
            }
        }
        if (($tache <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $this->loadModel('Taches');
        $tach = $this->Taches->newEmptyEntity();
        if ($this->request->is('post')) {
            $tach = $this->Taches->patchEntity($tach, $this->request->getData());
            if ($this->Taches->save($tach)) {

                $idtache = $tach->id;
                $taches = $this->Taches->query('SELECT taches.id id, taches.name name from taches');
                $connection = ConnectionManager::get('default');
                $heure = $connection->execute('SELECT duree FROM taches WHERE taches.id =' . $idtache . ';')->fetchAll('assoc');
                $minute = $connection->execute('SELECT dureem FROM taches WHERE taches.id =' . $idtache . ';')->fetchAll('assoc');
                $heureValue = $heure[0]['duree'];
                $minuteValue = $minute[0]['dureem'];

                // $select = "<select   name='data[tabletache][tache_id]' class='form-control'  champ='tache_id' id='tache_id' style = 'text-align:right'>";
                $select = "<option value=''></option>";
                foreach ($taches as $f) {
                    if ($f['id'] == $idtache) {
                        $selected = "selected";
                    } else {
                        $selected = "";
                    }
                    $select = $select . "<option value=" . $f['id'] . " " . $selected . " >" . $f['libelle'] . " </option>";
                }
                //$select = $select . '</select>';
            ?>
                <script>
                    var heureValue = '<?php echo $heureValue; ?>';
                    var minuteValue = '<?php echo $minuteValue; ?>';
                    var select = `<?php echo $select; ?>`;
                    window.opener.document.getElementById('HH<?php echo $index; ?>').value = heureValue;
                    window.opener.document.getElementById('MM<?php echo $index; ?>').value = minuteValue;
                    window.opener.document.getElementById('tache_id<?php echo $index; ?>').innerHTML = select;
                    window.close();
                </script>
            <?php
            }
        }


        $projets = $this->Taches->Projets->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $progressions = $this->Taches->Progressions->find('list', ['keyfield' => 'id', 'valueField' => 'valeur']);
        $this->set(compact('tach', 'project_id', 'projets', 'progressions'));
    }
    public function edittempcons($id = null, $project_id = null)
    {
        $this->LoadModel('Tacheassigns');
        $tacheassign = $this->Tacheassigns->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tacheassign = $this->Tacheassigns->patchEntity($tacheassign, $this->request->getData());
            if ($this->Tacheassigns->save($tacheassign)) {
                $this->misejour("Tacheassigns", "edit", $id);
                $projet_id = $tacheassign['projet_id'];
                $this->loadModel('Projets');
                $projet = $this->Projets->get($projet_id);
                $datetimeActuelle = FrozenTime::now();
                $datetimeActuelle->format('Y-m-d H:i:s');
                $projet->datemodification = $datetimeActuelle;
                $this->Projets->save($projet);
                return $this->redirect(['action' => 'vieww/', $project_id]);
            }
        }
        $taches = $this->fetchTable('Taches')->find('list', ['keyfield' => 'id', 'valueField' => 'libelle']);
        $personnels = $this->fetchTable('Personnels')->find('list', ['keyfield' => 'id', 'valueField' => 'nom']);
        $this->set(compact('project_id', 'tacheassign', 'personnels', 'taches'));
    }
    public function deletetempcons($id = null, $project_id = null)
    {
        $this->LoadModel('Tacheassigns');
        $tacheassign = $this->Tacheassigns->get($id);
        if ($this->Tacheassigns->delete($tacheassign)) {
            $this->misejour("Tacheassigns", "delete", $id);
            $projet_id = $tacheassign['projet_id'];
            $this->loadModel('Projets');
            $projet = $this->Projets->get($projet_id);
            $datetimeActuelle = FrozenTime::now();
            $datetimeActuelle->format('Y-m-d H:i:s');
            $projet->datemodification = $datetimeActuelle;
            $this->Projets->save($projet);
        } else {
        }
        return $this->redirect(['action' => 'vieww/', $project_id]);
    }
    public function viewtempcons($id = null, $project_id = null)
    {
        $this->LoadModel('Tacheassigns');
        $tacheassign = $this->Tacheassigns->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tacheassign = $this->Tacheassigns->patchEntity($tacheassign, $this->request->getData());
            if ($this->Tacheassigns->save($tacheassign)) {
                return $this->redirect(['action' => 'vieww/', $project_id]);
            }
        }
        $taches = $this->fetchTable('Taches')->find('list', ['keyfield' => 'id', 'valueField' => 'libelle']);
        $personnels = $this->fetchTable('Personnels')->find('list', ['keyfield' => 'id', 'valueField' => 'nom']);
        $this->set(compact('project_id', 'tacheassign', 'personnels', 'taches'));
    }
    public function adddevise()
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_parametrage' . $abrv);
        $societe = 0;
        foreach ($liendd as $k => $liens) {
            if (@$liens['lien'] == 'devises') {
                $societe = $liens['ajout'];
            }
        }
        if (($societe <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $this->loadModel('Devises');
        $devise = $this->Devises->newEmptyEntity();
        if ($this->request->is('post')) {
            $devise = $this->Devises->patchEntity($devise, $this->request->getData());
            if ($this->Devises->save($devise)) {
                $id = $devise->id;
                $devise = $this->Devises->query('SELECT devises.id id, devises.name name from devises');
                //$select = "<select   name='data[devises][devise_id]' class='form-control'  champ='devise_id' id='devise_id' style = 'text-align:right'>";
                $select = "<option value=''></option>";
                foreach ($devise as $f) {
                    if ($f['id'] == $id) {
                        $selected = "selected";
                    } else {
                        $selected = "";
                    }
                    $select = $select . "<option value=" . $f['id'] . " " . $selected . " >" . $f['name'] . " </option>";
                }
                //$select = $select . '</select>';
            ?>
                <script language="javascript">
                    window.opener.document.getElementById('devise_id').innerHTML = "<?php echo $select; ?>";
                </script>
                <script language="javascript">
                    window.close();
                </script>
            <?php
            }
        }
        $this->set(compact('devise'));
    }
    public function addbanque()
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_parametrage' . $abrv);
        $societe = 0;
        foreach ($liendd as $k => $liens) {
            if (@$liens['lien'] == 'banques') {
                $societe = $liens['ajout'];
            }
        }
        if (($societe <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $this->loadModel('Banques');
        $devises = $this->fetchTable('Devises')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $banque = $this->Banques->newEmptyEntity();
        if ($this->request->is('post')) {
            $banque = $this->Banques->patchEntity($banque, $this->request->getData());
            if ($this->Banques->save($banque)) {
                $id = $banque->id;
                $banque = $this->Banques->query('SELECT banques.id id, banques.name name from banques');
                // $select = "<select   name='data[banques][banque_id]' class='form-control'  champ='banque_id' id='banque_id' style = 'text-align:right'>";
                $select = "<option value=''></option>";
                foreach ($banque as $f) {
                    if ($f['id'] == $id) {
                        $selected = "selected";
                    } else {
                        $selected = "";
                    }
                    $select = $select . "<option value=" . $f['id'] . " " . $selected . " >" . $f['name'] . " </option>";
                }
                //$select = $select . '</select>';
            ?>
                <script language="javascript">
                    window.opener.document.getElementById('banque_id').innerHTML = "<?php echo $select; ?>";
                </script>
                <script language="javascript">
                    window.close();
                </script>
            <?php
            }
        }
        $this->set(compact('banque', 'devises'));
    }
    public function addbank($index = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_parametrage' . $abrv);
        $societe = 0;
        foreach ($liendd as $k => $liens) {
            if (@$liens['lien'] == 'banques') {
                $societe = $liens['ajout'];
            }
        }
        if (($societe <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $this->loadModel('Banques');


        $banque = $this->Banques->newEmptyEntity();
        if ($this->request->is('post')) {
            $banque = $this->Banques->patchEntity($banque, $this->request->getData());
            if ($this->Banques->save($banque)) {
                $id = $banque->id;
                $banque = $this->Banques->query('SELECT banques.id id, banques.name name from banques');
                $select = "<select   name='data[tabligne3][" . $index . "][banque_id]' class='form-control'  champ='banque_id' id='banque_id" . $index . "' style = 'text-align:right'>";
                $select = $select . "<option value=''></option>";
                foreach ($banque as $f) {
                    if ($f['id'] == $id) {
                        $selected = "selected";
                    } else {
                        $selected = "";
                    }
                    $select = $select . "<option value=" . $f['id'] . " " . $selected . " >" . $f['name'] . " </option>";
                }
                $select = $select . '</select>';
            ?>
                <script language="javascript">
                    window.opener.document.getElementById('banque_id<?php echo $index; ?>').innerHTML = "<?php echo $select; ?>";
                </script>
                <script language="javascript">
                    window.close();
                </script>
<?php
            }
        }
        $this->set(compact('banque'));
    }
    public function add()
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_projet' . $abrv);
        $projet = 0;
        foreach ($liendd as $k => $liens) {
            if (@$liens['lien'] == 'projets') {
                $projet = $liens['ajout'];
            }
        }
        if (($projet <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $tachedesignationall = $this->fetchTable('Tachedesignations')->find('all');

        $num = $this->Projets->find()->select([
            "num" =>
            'MAX(Projets.libelle)'
        ])->first();

        $numero = $num->num;
        // print_r($numero);
        if ($numero != null) {
            // print_r($numero);
            $inc = intval(substr($numero, 2, 6)) + 1;
            // print_r(substr($numero, 1, 5));
            $c = str_pad("$inc", 5, '0', STR_PAD_LEFT);
            $code = str_pad($c, 7, 'PJ', STR_PAD_LEFT);
        } else {
            $code = "PJ00001";
        }
        // print_r($code);
        $projet = $this->Projets->newEmptyEntity();
        $connection = ConnectionManager::get('default');
        // $liste3Projets = $connection->execute('ALTER TABLE `projets` ADD `comptesBank_id` INT NULL;')->fetchAll('assoc');
        // die;
        if ($this->request->is('post')) {

            $projet['datemodification'] = date('Y-m-d H:i:s');
            //            foreach ($this->request->getData('data')['lignec'] as $i => $lignec) {
            //                if ($lignec['sup6'] != 1) {
            $client_id = $lignec['nameC'];
            // debug($client_id);
            $projet = $this->fetchTable('Projets')->newEmptyEntity();
            $projet = $this->Projets->patchEntity($projet, $this->request->getData());
            // $projet['client_id'] = $client_id;
            // debug($projet);
            // debug($projet['client_id']);

            if ($this->Projets->save($projet)) {


                $this->loadModel('Tacheprojets');
                $projet_id = $projet->id;
                $this->misejour("Projets", "add", $projet_id);
                foreach ($tachedesignationall as $j => $tache) {
                    $data['projet_id'] = $projet_id;
                    $data['tachedesignation_id'] = $tache->id;
                    $tacheprojet = $this->fetchTable('Tacheprojets')->newEmptyEntity();
                    $tacheprojet = $this->Tacheprojets->patchEntity($tacheprojet, $data);
                    if ($this->Tacheprojets->save($tacheprojet)) {
                        $this->misejour("Tacheprojets", "add", $tacheprojet->id);
                        $projet->etatTache = 1;
                        $projetData = $this->fetchTable('Projets')->patchEntity($projet, $projet->toArray());
                        $this->fetchTable('Projets')->save($projetData);
                    }
                }
                if (isset($this->request->getData('data')['fichier']) && (!empty($this->request->getData('data')['fichier']))) {
                    foreach ($this->request->getData('data')['fichier'] as $i => $fich) {
                        if ($fich['sup1'] != 1) {
                            $logo = $fich['pdf'];
                            $name = $logo->getClientFilename();
                            $targetPath = WWW_ROOT . 'img' . DS . 'logoclients' . DS . $name;
                            if ($name) {
                                $logo->moveTo($targetPath);
                                $data['fichier'] = $name;
                            }
                            $this->loadModel('Pdfs');
                            $fichierpdf = $this->Pdfs->newEmptyEntity();
                            $data['projet_id'] = $projet_id;
                            $fichierpdf = $this->Pdfs->patchEntity($fichierpdf, $data);

                            if ($this->Pdfs->save($fichierpdf)) {

                                $this->misejour("Pdfs", "add", $fichierpdf->id);
                            }
                        }
                    }
                }
                if (isset($this->request->getData('data')['ligne']) && (!empty($this->request->getData('data')['ligne']))) {
                    foreach ($this->request->getData('data')['ligne'] as $i => $ligne) {
                        if ($ligne['sup1'] != 1) {
                            $this->loadModel('Responsableprojets');
                            $responsableprojets = $this->Responsableprojets->newEmptyEntity();
                            $data['projet_id'] = $projet_id;
                            $data['personnel_id'] = $ligne['personnel_id'];
                            $responsableprojets = $this->Responsableprojets->patchEntity($responsableprojets, $data);

                            if ($this->Responsableprojets->save($responsableprojets)) {

                                $this->misejour("Responsableprojets", "add", $responsableprojets->id);
                            }
                        }
                    }
                }
                if (isset($this->request->getData('data')['lignea']) && (!empty($this->request->getData('data')['lignea']))) {
                    foreach ($this->request->getData('data')['lignea'] as $i => $lignea) {
                        if ($lignea['sup0'] != 1) {
                            $this->loadModel('Ligneprojetarticles');
                            $ligneprarticle = $this->Ligneprojetarticles->newEmptyEntity();
                            $data['projet_id'] = $projet_id;
                            if ($lignea['article_id']) {
                                $data['article_id'] = $lignea['article_id'];
                            } else {
                                $data['articlename'] = $lignea['article_idd'];
                            }

                            $ligneprjarticle = $this->Ligneprojetarticles->patchEntity($ligneprarticle, $data);
                            $this->Ligneprojetarticles->save($ligneprjarticle);
                        }
                    }
                }
                if (isset($this->request->getData('data')['lignef']) && (!empty($this->request->getData('data')['lignef']))) {
                    foreach ($this->request->getData('data')['lignef'] as $i => $lignef) {
                        if ($lignef['sup1'] != 1) {
                            $this->loadModel('Ligneprojetfournisseurs');
                            $ligneprfour = $this->Ligneprojetfournisseurs->newEmptyEntity();
                            $data['projet_id'] = $projet_id;
                            if ($lignef['fournisseur_id']) {
                                $data['fournisseur_id'] = $lignef['fournisseur_id'];
                            } else {
                                $data['fourname'] = $lignef['nameF'];
                            }
                            $ligneprfrs = $this->Ligneprojetfournisseurs->patchEntity($ligneprfour, $data);
                            $this->Ligneprojetfournisseurs->save($ligneprfrs);
                        }
                    }
                }

                /// if (isset($this->request->getData('data')['lignec']) && (!empty($this->request->getData('data')['lignec']))) {
                //foreach ($this->request->getData('data')['lignec'] as $i => $lignec) {
                foreach ($this->request->getData('data')['lignec'] as $i => $lignec) {
                    if ($lignec['sup6'] != 1) {

                        $this->loadModel('Ligneprojetclients');
                        $ligneprcli = $this->Ligneprojetclients->newEmptyEntity();
                        $data['projet_id'] = $projet_id;

                        $data['client_id'] = $lignec['client_id'];


                        $ligneprjcli = $this->Ligneprojetclients->patchEntity($ligneprcli, $data);
                        $this->Ligneprojetclients->save($ligneprjcli);
                    }
                }
            }
            //                }
            //            }
            return $this->redirect(['action' => 'vieww/' . $projet_id]);
        }
        $this->loadModel('Tagcategories');
        $this->loadModel('Clients');
        $this->loadModel('Opportunites');
        $this->loadModel('Personnels');
        $this->loadModel('Commercials');
        $this->loadModel('Banques');
        $this->loadModel('Devises');
        $this->loadModel('Fournisseurs');
        $this->loadModel('Articles');
        $devises = $this->fetchTable('Devises')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $banquesssss = $this->Banques->find('list', [
            'keyField' => 'id',
            'valueField' => function ($banque) {
                if ($banque->devise_id != null) {
                    $devises_name = $this->fetchTable('Devises')->find()
                        ->select(['name'])
                        ->where(['id' => $banque->devise_id])
                        ->first();
                }
                return $banque->name . '   ' . $devises_name->name;
            }
        ]);
        $user_id = $this->request->getAttribute('identity')->id;
        $user = $this->fetchTable('Users')->find('all')->where(['Users.id' => $user_id])->first();
        $personnel_id = $user->personnel_id;
        $commercials = $this->Personnels->find('list', ['keyField' => 'id', 'valueField' => 'nom'])->where(['fonction_id' => 9]);
        $banques = $this->fetchTable('Banques')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $devises = $this->fetchTable('Devises')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $personnels = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom']);
        $opportunites = $this->Opportunites->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $clients = $this->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'Raison_Sociale']);
        $articles = $this->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'nom']);
        $tagcategories = $this->Tagcategories->find('list', ['keyfield' => 'id', 'valueField' => 'reference']);
        $fournisseurs = $this->Fournisseurs->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $nbrejours = $this->fetchTable('Parametragejours')->find()->first();
        $this->set(compact('banquesssss', 'tagcategories', 'nbrejours', 'articles', 'fournisseurs', 'personnel_id', 'banques', 'devises', 'projet', 'clients', 'code', 'opportunites', 'commercials', 'personnels'));
    }
    public function add040324()
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_projet' . $abrv);
        $projet = 0;
        foreach ($liendd as $k => $liens) {
            if (@$liens['lien'] == 'projets') {
                $projet = $liens['ajout'];
            }
        }
        if (($projet <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $tachedesignationall = $this->fetchTable('Tachedesignations')->find('all');

        $num = $this->Projets->find()->select([
            "num" =>
            'MAX(Projets.libelle)'
        ])->first();
        $numero = $num->num;
        if ($numero != null) {
            $inc = intval(substr($numero, 1, 5)) + 1;
            $c = str_pad("$inc", 5, '0', STR_PAD_LEFT);
            $code = str_pad($c, 7, 'PJ', STR_PAD_LEFT);
        } else {
            $code = "PJ00001";
        }
        $projet = $this->Projets->newEmptyEntity();
        if ($this->request->is('post')) {

            $projet['datemodification'] = date('Y-m-d H:i:s');
            $projet = $this->Projets->patchEntity($projet, $this->request->getData());
            if ($this->Projets->save($projet)) {
                $this->loadModel('Tacheprojets');
                $projet_id = $projet->id;
                foreach ($tachedesignationall as $j => $tache) {
                    $data['projet_id'] = $projet_id;
                    $data['tachedesignation_id'] = $tache->id;
                    $tacheprojet = $this->fetchTable('Tacheprojets')->newEmptyEntity();
                    $tacheprojet = $this->Tacheprojets->patchEntity($tacheprojet, $data);
                    if ($this->Tacheprojets->save($tacheprojet)) {
                        $projet->etatTache = 1;
                        $projetData = $this->fetchTable('Projets')->patchEntity($projet, $projet->toArray());
                        $this->fetchTable('Projets')->save($projetData);
                    }
                }
                if (isset($this->request->getData('data')['fichier']) && (!empty($this->request->getData('data')['fichier']))) {
                    foreach ($this->request->getData('data')['fichier'] as $i => $fich) {
                        if ($fich['sup1'] != 1) {
                            $logo = $fich['pdf'];
                            $name = $logo->getClientFilename();
                            $targetPath = WWW_ROOT . 'img' . DS . 'logoclients' . DS . $name;
                            if ($name) {
                                $logo->moveTo($targetPath);
                                $data['fichier'] = $name;
                            }
                            $this->loadModel('Pdfs');
                            $fichierpdf = $this->Pdfs->newEmptyEntity();
                            $data['projet_id'] = $projet_id;
                            $fichierpdf = $this->Pdfs->patchEntity($fichierpdf, $data);
                            $this->Pdfs->save($fichierpdf);
                        }
                    }
                }
                if (isset($this->request->getData('data')['ligne']) && (!empty($this->request->getData('data')['ligne']))) {
                    foreach ($this->request->getData('data')['ligne'] as $i => $ligne) {
                        if ($ligne['sup1'] != 1) {
                            $this->loadModel('Responsableprojets');
                            $responsableprojets = $this->Responsableprojets->newEmptyEntity();
                            $data['projet_id'] = $projet_id;
                            $data['personnel_id'] = $ligne['personnel_id'];
                            $responsableprojets = $this->Responsableprojets->patchEntity($responsableprojets, $data);
                            $this->Responsableprojets->save($responsableprojets);
                        }
                    }
                }
                if (isset($this->request->getData('data')['lignea']) && (!empty($this->request->getData('data')['lignea']))) {
                    foreach ($this->request->getData('data')['lignea'] as $i => $lignea) {
                        if ($lignea['sup0'] != 1) {
                            $this->loadModel('Ligneprojetarticles');
                            $ligneprarticle = $this->Ligneprojetarticles->newEmptyEntity();
                            $data['projet_id'] = $projet_id;
                            if ($lignea['article_id']) {
                                $data['article_id'] = $lignea['article_id'];
                            } else {
                                $data['articlename'] = $lignea['article_idd'];
                            }

                            $ligneprjarticle = $this->Ligneprojetarticles->patchEntity($ligneprarticle, $data);
                            $this->Ligneprojetarticles->save($ligneprjarticle);
                        }
                    }
                }
                if (isset($this->request->getData('data')['lignef']) && (!empty($this->request->getData('data')['lignef']))) {
                    foreach ($this->request->getData('data')['lignef'] as $i => $lignef) {
                        if ($lignef['sup1'] != 1) {
                            $this->loadModel('Ligneprojetfournisseurs');
                            $ligneprfour = $this->Ligneprojetfournisseurs->newEmptyEntity();
                            $data['projet_id'] = $projet_id;
                            if ($lignef['fournisseur_id']) {
                                $data['fournisseur_id'] = $lignef['fournisseur_id'];
                            } else {
                                $data['fourname'] = $lignef['nameF'];
                            }
                            $ligneprfrs = $this->Ligneprojetfournisseurs->patchEntity($ligneprfour, $data);
                            $this->Ligneprojetfournisseurs->save($ligneprfrs);
                        }
                    }
                }

                if (isset($this->request->getData('data')['lignec']) && (!empty($this->request->getData('data')['lignec']))) {
                    foreach ($this->request->getData('data')['lignec'] as $i => $lignec) {
                        if ($lignec['sup6'] != 1) {
                            $this->loadModel('Ligneprojetclients');
                            $ligneprcli = $this->Ligneprojetclients->newEmptyEntity();
                            $data['projet_id'] = $projet_id;
                            if ($lignef['fournisseur_id']) {
                                $data['client_id'] = $lignec['client_id'];
                            } else {
                                $data['clientname'] = $lignec['nameC'];
                            }
                            $ligneprjcli = $this->Ligneprojetclients->patchEntity($ligneprcli, $data);
                            $this->Ligneprojetclients->save($ligneprjcli);
                        }
                    }
                }

                return $this->redirect(['action' => 'index']);
            }
        }
        $this->loadModel('Clients');
        $this->loadModel('Opportunites');
        $this->loadModel('Personnels');
        $this->loadModel('Commercials');
        $this->loadModel('Banques');
        $this->loadModel('Devises');
        $this->loadModel('Fournisseurs');
        $this->loadModel('Articles');
        $devises = $this->fetchTable('Devises')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $banquesssss = $this->Banques->find('list', [
            'keyField' => 'id',
            'valueField' => function ($banque) {
                if ($banque->devise_id != null) {
                    $devises_name = $this->fetchTable('Devises')->find()
                        ->select(['name'])
                        ->where(['id' => $banque->devise_id])
                        ->first();
                }
                return $banque->name . '   ' . $devises_name->name;
            }
        ]);
        $user_id = $this->request->getAttribute('identity')->id;
        $user = $this->fetchTable('Users')->find('all')->where(['Users.id' => $user_id])->first();
        $personnel_id = $user->personnel_id;
        $commercials = $this->Personnels->find('list', ['keyField' => 'id', 'valueField' => 'nom'])->where(['fonction_id' => 9]);
        $banques = $this->fetchTable('Banques')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $devises = $this->fetchTable('Devises')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $personnels = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom']);
        $opportunites = $this->Opportunites->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $clients = $this->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'nom']);
        $articles = $this->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'nom']);

        $fournisseurs = $this->Fournisseurs->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $this->set(compact('banquesssss', 'articles', 'fournisseurs', 'personnel_id', 'banques', 'devises', 'projet', 'clients', 'code', 'opportunites', 'commercials', 'personnels'));
    }
    public function edit($id = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_projet' . $abrv);
        $projet = 0;
        foreach ($liendd as $k => $liens) {
            if (@$liens['lien'] == 'projets') {
                $projet = $liens['modif'];
            }
        }
        if (($projet <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $projet = $this->Projets->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $this->loadModel('Projets');

            $datetimeActuelle = FrozenTime::now();
            $datetimeActuelle->format('Y-m-d H:i:s');
            $projet->datemodification = $datetimeActuelle;

            $projet = $this->Projets->patchEntity($projet, $this->request->getData());
            if ($this->Projets->save($projet)) {
                $this->misejour("Projets", "edit", $id);
                $this->loadModel('Pdfs');
                $fichierpdfexit = $this->Pdfs->find('all')->where('Pdfs.projet_id =' . $id);
                $this->loadModel('Responsableprojets');
                $ligneexistes = $this->Responsableprojets->find('all')->where('Responsableprojets.projet_id =' . $id);
                foreach ($ligneexistes as $l) {
                    $this->Responsableprojets->delete($l);
                }
                $projet_id = $projet->id;
                if (isset($this->request->getData('data')['ligne']) && (!empty($this->request->getData('data')['ligne']))) {
                    foreach ($this->request->getData('data')['ligne'] as $i => $ligne) {
                        if ($ligne['sup1'] != 1) {
                            $responsableprojets = $this->Responsableprojets->newEmptyEntity();
                            $data['projet_id'] = $projet_id;
                            $data['personnel_id'] = $ligne['personnel_id'];
                            $responsableprojets = $this->Responsableprojets->patchEntity($responsableprojets, $data);
                            $this->Responsableprojets->save($responsableprojets);
                        }
                    }
                }

                if (isset($this->request->getData('data')['fichier']) && (!empty($this->request->getData('data')['fichier']))) {
                    foreach ($this->request->getData('data')['fichier'] as $i => $exon) {
                        $this->loadModel('Exonerations');
                        if ($exon['sup1'] != 1) {
                            $data['projet_id'] = $projet_id;
                            if (isset($exon['id']) && (!empty($exon['id']))) {
                                $fichPdfs = $this->fetchTable('Pdfs')->get($exon['id'], [
                                    'contain' => []
                                ]);
                            } else {
                                $fichPdfs = $this->fetchTable('Pdfs')->newEmptyEntity();
                            };
                            $logo = $exon['pdf'];
                            if (!empty($logo)) {
                                $name = $logo->getClientFilename();
                                $targetPath = WWW_ROOT . 'img' . DS . 'logoclients' . DS . $name;
                                if ($name) {
                                    $logo->moveTo($targetPath);
                                    $data['fichier'] = $name;
                                }
                            }
                            $fichPdfs = $this->fetchTable('Pdfs')->patchEntity($fichPdfs, $data);
                            if ($this->fetchTable('Pdfs')->save($fichPdfs)) {
                            } else {
                            }
                        } else {
                            if (!empty($exon['id']))
                                $fichPdfs = $this->fetchTable('Pdfs')->get($exon['id']);
                            $this->fetchTable('Pdfs')->delete($fichPdfs);
                        }
                    }
                }
                // debug($id);
                $this->loadModel('Ligneprojetarticles');
                $lignepart = $this->Ligneprojetarticles->find('all')->where('Ligneprojetarticles.projet_id =' . $id);
                debug($lignepart);
                foreach ($lignepart as $l) {
                    $this->Ligneprojetarticles->delete($l);
                }
                if (isset($this->request->getData('data')['lignea']) && (!empty($this->request->getData('data')['lignea']))) {
                    foreach ($this->request->getData('data')['lignea'] as $i => $lignea) {
                        if ($lignea['sup0'] != 1) {
                            $this->loadModel('Ligneprojetarticles');
                            $ligneprarticle = $this->Ligneprojetarticles->newEmptyEntity();
                            $data['projet_id'] = $projet_id;
                            if ($lignea['article_id']) {
                                $data['article_id'] = $lignea['article_id'];
                            } else {
                                $data['articlename'] = $lignea['article_idd'];
                            }

                            $ligneprjarticle = $this->Ligneprojetarticles->patchEntity($ligneprarticle, $data);
                            $this->Ligneprojetarticles->save($ligneprjarticle);
                        }
                    }
                }
                $this->loadModel('Ligneprojetfournisseurs');
                $lignepfour = $this->Ligneprojetfournisseurs->find('all')->where('Ligneprojetfournisseurs.projet_id =' . $id);
                foreach ($lignepfour as $l) {
                    $this->Ligneprojetfournisseurs->delete($l);
                }
                if (isset($this->request->getData('data')['lignef']) && (!empty($this->request->getData('data')['lignef']))) {
                    foreach ($this->request->getData('data')['lignef'] as $i => $lignef) {
                        if ($lignef['sup1'] != 1) {
                            $this->loadModel('Ligneprojetfournisseurs');
                            $ligneprfour = $this->Ligneprojetfournisseurs->newEmptyEntity();
                            $data['projet_id'] = $projet_id;
                            if ($lignef['fournisseur_id']) {
                                $data['fournisseur_id'] = $lignef['fournisseur_id'];
                            } else {
                                $data['fourname'] = $lignef['nameF'];
                            }
                            $ligneprfrs = $this->Ligneprojetfournisseurs->patchEntity($ligneprfour, $data);
                            $this->Ligneprojetfournisseurs->save($ligneprfrs);
                        }
                    }
                }
                $this->loadModel('Ligneprojetclients');
                $lignepcli = $this->Ligneprojetclients->find('all')->where('Ligneprojetclients.projet_id =' . $id);
                // debug($lignepcli);
                foreach ($lignepcli as $l) {
                    $this->Ligneprojetclients->delete($l);
                }
                if (isset($this->request->getData('data')['lignec']) && (!empty($this->request->getData('data')['lignec']))) {
                    foreach ($this->request->getData('data')['lignec'] as $i => $lignec) {
                        if ($lignec['sup6'] != 1) {
                            $this->loadModel('Ligneprojetclients');
                            $ligneprcli = $this->Ligneprojetclients->newEmptyEntity();
                            $data['projet_id'] = $projet_id;
                            if ($lignef['fournisseur_id']) {
                                $data['client_id'] = $lignec['client_id'];
                            } else {
                                $data['clientname'] = $lignec['nameC'];
                            }
                            $ligneprjcli = $this->Ligneprojetclients->patchEntity($ligneprcli, $data);
                            $this->Ligneprojetclients->save($ligneprjcli);
                        }
                    }
                }
                return $this->redirect(['action' => 'index']);
            }
        }
        $this->loadModel('Clients');
        $this->loadModel('Opportunites');
        $this->loadModel('Personnels');
        $this->loadModel('Commercials');
        $this->loadModel('Banques');
        $this->loadModel('Devises');
        $this->loadModel('Fournisseurs');
        $this->loadModel('Articles');
        $this->loadModel('Tagcategories');
        $commercials = $this->Personnels->find('list', ['keyField' => 'id', 'valueField' => 'nom'])->where(['fonction_id' => 9]);
        $banques = $this->fetchTable('Banques')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $devises = $this->fetchTable('Devises')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $personnels = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom']);
        $this->loadModel('Responsableprojets');
        $this->loadModel('Ligneprojetarticles');
        $this->loadModel('Ligneprojetfournisseurs');
        $this->loadModel('Ligneprojetclients');

        $lignes = $this->Responsableprojets->find('all')->where('Responsableprojets.projet_id =' . $id);
        $ligneart = $this->Ligneprojetarticles->find('all')->where('Ligneprojetarticles.projet_id =' . $id);
        $lignefour = $this->Ligneprojetfournisseurs->find('all')->where('Ligneprojetfournisseurs.projet_id =' . $id);
        $lignecli = $this->Ligneprojetclients->find('all')->where('Ligneprojetclients.projet_id =' . $id);
        $this->loadModel('Pdfs');
        $fichierpdfs = $this->Pdfs->find('all')->where('Pdfs.projet_id =' . $id);
        $opportunites = $this->Opportunites->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $clients = $this->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'Raison_Sociale']);
        $opportunites = $this->Opportunites->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $articles = $this->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'nom']);
        $tagcategories = $this->Tagcategories->find('list', ['keyfield' => 'id', 'valueField' => 'reference']);
        $fournisseurs = $this->Fournisseurs->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        if ($projet['banque_id']) {
            $comptesBanks = $this->fetchtable('ComptesBank')->find('all'/* , ['keyfield' => 'id', 'valueField' => 'compte'] */)->where(['ComptesBank.banque_id' => $projet['banque_id']]);
        }
        $this->set(compact('banques', 'tagcategories', 'comptesBanks', 'articles', 'fournisseurs', 'ligneart', 'lignefour', 'lignecli', 'devises', 'fichierpdfs', 'projet', 'commercials', 'clients', 'personnels', 'opportunites', 'lignes'));
    }
    public function edit010324($id = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_projet' . $abrv);
        $projet = 0;
        foreach ($liendd as $k => $liens) {
            if (@$liens['lien'] == 'projets') {
                $projet = $liens['modif'];
            }
        }
        if (($projet <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $projet = $this->Projets->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $this->loadModel('Projets');

            $datetimeActuelle = FrozenTime::now();
            $datetimeActuelle->format('Y-m-d H:i:s');
            $projet->datemodification = $datetimeActuelle;

            $projet = $this->Projets->patchEntity($projet, $this->request->getData());
            if ($this->Projets->save($projet)) {
                $this->misejour("Projets", "edit", $id);
                $this->loadModel('Pdfs');
                $fichierpdfexit = $this->Pdfs->find('all')->where('Pdfs.projet_id =' . $id);
                $this->loadModel('Responsableprojets');
                $ligneexistes = $this->Responsableprojets->find('all')->where('Responsableprojets.projet_id =' . $id);
                foreach ($ligneexistes as $l) {
                    $this->Responsableprojets->delete($l);
                }
                $projet_id = $projet->id;
                if (isset($this->request->getData('data')['ligne']) && (!empty($this->request->getData('data')['ligne']))) {
                    foreach ($this->request->getData('data')['ligne'] as $i => $ligne) {
                        if ($ligne['sup1'] != 1) {
                            $responsableprojets = $this->Responsableprojets->newEmptyEntity();
                            $data['projet_id'] = $projet_id;
                            $data['personnel_id'] = $ligne['personnel_id'];
                            $responsableprojets = $this->Responsableprojets->patchEntity($responsableprojets, $data);
                            $this->Responsableprojets->save($responsableprojets);
                        }
                    }
                }
                if (isset($this->request->getData('data')['fichier']) && (!empty($this->request->getData('data')['fichier']))) {
                    foreach ($this->request->getData('data')['fichier'] as $i => $exon) {
                        $this->loadModel('Exonerations');
                        if ($exon['sup1'] != 1) {
                            $data['projet_id'] = $projet_id;
                            if (isset($exon['id']) && (!empty($exon['id']))) {
                                $fichPdfs = $this->fetchTable('Pdfs')->get($exon['id'], [
                                    'contain' => []
                                ]);
                            } else {
                                $fichPdfs = $this->fetchTable('Pdfs')->newEmptyEntity();
                            };
                            $logo = $exon['pdf'];
                            if (!empty($logo)) {
                                $name = $logo->getClientFilename();
                                $targetPath = WWW_ROOT . 'img' . DS . 'logoclients' . DS . $name;
                                if ($name) {
                                    $logo->moveTo($targetPath);
                                    $data['fichier'] = $name;
                                }
                            }
                            $fichPdfs = $this->fetchTable('Pdfs')->patchEntity($fichPdfs, $data);
                            if ($this->fetchTable('Pdfs')->save($fichPdfs)) {
                            } else {
                            }
                        } else {
                            if (!empty($exon['id']))
                                $fichPdfs = $this->fetchTable('Pdfs')->get($exon['id']);
                            $this->fetchTable('Pdfs')->delete($fichPdfs);
                        }
                    }
                }
                return $this->redirect(['action' => 'index']);
            }
        }
        $this->loadModel('Clients');
        $this->loadModel('Opportunites');
        $this->loadModel('Personnels');
        $this->loadModel('Commercials');
        $this->loadModel('Banques');
        $this->loadModel('Devises');
        $commercials = $this->Personnels->find('list', ['keyField' => 'id', 'valueField' => 'nom'])->where(['fonction_id' => 9]);
        $banques = $this->fetchTable('Banques')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $devises = $this->fetchTable('Devises')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $personnels = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom']);
        $this->loadModel('Responsableprojets');
        $lignes = $this->Responsableprojets->find('all')->where('Responsableprojets.projet_id =' . $id);
        $this->loadModel('Pdfs');
        $fichierpdfs = $this->Pdfs->find('all')->where('Pdfs.projet_id =' . $id);
        $opportunites = $this->Opportunites->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $clients = $this->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'nom']);
        $this->set(compact('banques', 'devises', 'fichierpdfs', 'projet', 'commercials', 'clients', 'personnels', 'opportunites', 'lignes'));
    }
    public function delete($id = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_projet' . $abrv);

        $projet = 0;
        foreach ($liendd as $k => $liens) {
            if (@$liens['lien'] == 'projets') {
                $projet = $liens['supp'];
            }
        }
        if (($projet <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $this->loadModel('Projets');

        $projet = $this->Projets->get($id);
        $datetimeActuelle = FrozenTime::now();
        $datetimeActuelle->format('Y-m-d H:i:s');
        $projet->datemodification = $datetimeActuelle;

        if ($this->Projets->delete($projet)) {
            $this->misejour("Projets", "Delete", $id);
            $this->loadModel('Responsableprojets');
            $ligneexistes = $this->Responsableprojets->find('all')->where('Responsableprojets.projet_id =' . $id);
            foreach ($ligneexistes as $l) {
                $this->Responsableprojets->delete($l);
            }
        } else {
        }
        return $this->redirect(['action' => 'index']);
    }
    public function verifdeldof()
    {
        $id = $this->request->getQuery('id');
        $bande = $this->fetchTable('Bandeconsultations')->find('all')->where(['Bandeconsultations.demandeoffredeprix_id =' . $id])->count();

        echo json_encode(array('bande' => $bande));
        die;
    }
    public function veriffacclient()
    {
        $id = $this->request->getQuery('id');
        $lignereg = $this->fetchTable('Lignereglementclients')->find('all')->where(['Lignereglementclients.factureclient_id =' . $id])->count();
        echo json_encode(array('lignereg' => $lignereg));
        die;
    }
    public function veriffacfour()
    {
        $id = $this->request->getQuery('id');
        $regl = $this->fetchTable('Lignereglements')->find('all')->where(['Lignereglements.facture_id =' . $id])->count();
        echo json_encode(array('regl' => $regl));
        die;
    }
    public function verifprojets()
    {
        $id = $this->request->getQuery('id');
        $reglementfournis = $this->fetchTable('Reglements')->find('all')->where(['Reglements.projet_id =' . $id])->count();
        $reglementclients = $this->fetchTable('Reglementclients')->find('all')->where(['Reglementclients.projet_id =' . $id])->count();
        $taches = $this->fetchTable('Taches')->find('all')->where(['Taches.projet_id =' . $id])->count();
        $commandefournisseurs = $this->fetchTable('Commandefournisseurs')->find('all')->where(['Commandefournisseurs.projet_id =' . $id])->count();
        $demandeoffredeprixes = $this->fetchTable('Demandeoffredeprixes')->find('all')->where(['Demandeoffredeprixes.projet_id =' . $id])->count();
        $factureclients = $this->fetchTable('Factureclients')->find('all')->where(['Factureclients.projet_id =' . $id])->count();
        $factures = $this->fetchTable('Factures')->find('all')->where(['Factures.projet_id =' . $id])->count();
        $commandeclients = $this->fetchTable('Commandeclients')->find('all')->where(['Commandeclients.projet_id =' . $id])->count();
        echo json_encode(
            array(
                'commandeclients' => $commandeclients,
                'reglementclients' => $reglementclients,
                'reglementfournis' => $reglementfournis,
                'taches' => $taches,
                'commandefournisseurs' => $commandefournisseurs,
                'factureclients' => $factureclients,
                'demandeoffredeprixes' => $demandeoffredeprixes,
                'factureclients' => $factureclients,
                'factures' => $factures,
            )
        );
        die;
    }
    public function viewtache($id = null, $project_id = null)
    {
        $this->loadmodel('Taches');
        $tach = $this->Taches->get($id, [
            'contain' => ['Projets', 'Progressions'],
        ]);
        $projets = $this->Taches->Projets->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $progressions = $this->Taches->Progressions->find('list', ['keyfield' => 'id', 'valueField' => 'valeur']);
        $personnels = $this->fetchTable('Personnels')->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->all();

        $this->set(compact('tach', 'personnels', 'project_id', 'projets', 'progressions'));
    }
    public function edittache($id = null, $project_id = null)
    {
        $this->loadmodel('Taches');
        $tach = $this->Taches->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tach = $this->Taches->patchEntity($tach, $this->request->getData());
            if ($this->Taches->save($tach)) {
                $this->misejour("Taches", "edit", $id);
                $projet_id = $tach['projet_id'];
                $this->loadModel('Projets');
                $projet = $this->Projets->get($projet_id);
                $datetimeActuelle = FrozenTime::now();
                $datetimeActuelle->format('Y-m-d H:i:s');
                $projet->datemodification = $datetimeActuelle;
                $this->Projets->save($projet);
                return $this->redirect(['action' => 'vieww/', $project_id]);
            }
        }
        $projets = $this->Taches->Projets->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $progressions = $this->Taches->Progressions->find('list', ['keyfield' => 'id', 'valueField' => 'valeur']);
        $personnels = $this->fetchTable('Personnels')->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->all();

        $this->set(compact('tach', 'personnels', 'projets', 'project_id', 'progressions'));
    }

    public function deletetache($id = null, $project_id = null)
    {
        $this->loadmodel('Taches');
        $this->request->allowMethod(['post', 'delete']);
        $tach = $this->Taches->get($id);
        if ($this->Taches->delete($tach)) {
            $this->misejour("Tache", "Delete", $id);
            $projet_id = $tach['projet_id'];
            $this->loadModel('Projets');
            $projet = $this->Projets->get($projet_id);
            $datetimeActuelle = FrozenTime::now();
            $datetimeActuelle->format('Y-m-d H:i:s');
            $projet->datemodification = $datetimeActuelle;
            $this->Projets->save($projet);
        } else {
        }
        return $this->redirect(['action' => 'vieww/', $project_id]);
    }

    public function viewcontrat($id = null, $project_id = null)
    {
        $this->loadmodel('Contrats');
        $contrat = $this->Contrats->get($id, [
            'contain' => [],
        ]);
        $Contrats = $this->fetchTable('Contrats')->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->all();
        $projets = $this->fetchTable('Projets')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $personnels = $this->fetchTable('Personnels')->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where('Personnels.fonction_id = 9');
        $this->set(compact('contrat', 'project_id', 'Contrats', 'projets', 'personnels'));
    }
    public function editcontrat($id = null, $project_id = null)
    {
        $this->loadmodel('Contrats');

        $contrat = $this->Contrats->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $contrat = $this->Contrats->patchEntity($contrat, $this->request->getData());
            if ($this->Contrats->save($contrat)) {
                $this->misejour("Contrat", "edit", $id);
                $projet_id = $contrat['projet_id'];
                $this->loadModel('Projets');
                $projet = $this->Projets->get($projet_id);
                $datetimeActuelle = FrozenTime::now();
                $datetimeActuelle->format('Y-m-d H:i:s');
                $projet->datemodification = $datetimeActuelle;
                $this->Projets->save($projet);
                return $this->redirect(['action' => 'index']);
            }
        }
        $Contrats = $this->fetchTable('Contrats')->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->all();
        $projets = $this->fetchTable('Projets')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $personnels = $this->fetchTable('Personnels')->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where('Personnels.fonction_id = 9');

        $this->set(compact('contrat', 'project_id', 'Contrats', 'projets', 'personnels'));
    }
    public function deletecontrat($id = null, $project_id = null)
    {
        $this->loadmodel('Contrats');

        $this->request->allowMethod(['post', 'delete']);
        $contrat = $this->Contrats->get($id);
        if ($this->Contrats->delete($contrat)) {
            $this->misejour("Contrat", "delete", $id);
            $projet_id = $contrat['projet_id'];
            $this->loadModel('Projets');
            $projet = $this->Projets->get($projet_id);
            $datetimeActuelle = FrozenTime::now();
            $datetimeActuelle->format('Y-m-d H:i:s');
            $projet->datemodification = $datetimeActuelle;
            $this->Projets->save($projet);
        } else {
        }

        return $this->redirect(['action' => 'vieww/', $project_id]);
    }
}
