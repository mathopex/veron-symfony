<?php

namespace App\Service;

use App\Repository\RawRepository;
use App\Repository\UserRepository;
use App\Repository\EshreRepository;
use App\Repository\ConservationRepository;

/**
 * Class calculService
 */

 class CalculService {
    
    public function __construct(RawRepository $rawRepository, UserRepository $userRepository, EshreRepository $eshreRepository,ConservationRepository $conservationRepository){

        $this->rawRepository = $rawRepository;
        $this->userRepository = $userRepository;
        $this->eshreRepository = $eshreRepository;
        $this->conservationRepository = $conservationRepository;
    }

    public function calculRecette(array $ids, array $tableau) {

        $raws = [];
        foreach ($ids as $id) {
            $raw = $this->rawRepository->getRawById($id);
            if ($raw !== null) {
                $raws[] = $raw;
            }
        }
       
        $aw=0;
        $cumulCuit = 0;
        $cumulAutre = 0;
        $nombreMatièresPremières = 0;
        $eau = 0;
        $totalParticipationMatierePremiere = 0;
        $matierePremiereParticipation = 0;
        $hre = 0;
        $alcoolPur = 0;
        $cacaoDegraisse = 0;
        $matiereGrasse = 0;
        $matiereGrasse0_20 = 0;
        $matiereGrasse21_32 = 0;
        $matiereGrasse33Plus = 0;
        $quantiteTotale=0;
        $quantiteTotaleRestante=0;
        $poidPerte = 0;
        $matiereSeche = 0;
        $cumulAutre = 0;
        $cumulSucre =0;
        $cumulMg=0;
        $cumulAutreTab = [];
        $indiceSucrant = 0;
        $calculeValue=[];

        // if (($nombreMatièresPremières < 5 && $hre === false) || ($nombreMatièresPremières < 2 && $hre === true)) {
        //     return;
        // }

        foreach($tableau as $key => $subArray) {

            $length = count($subArray['poidMp']);
            $sommePoids = array_sum($subArray['poidMp']);
            $sommePrix = array_sum($subArray['prixMp']);

            $calculeValue['poidTotal'] = $sommePoids;
            $calculeValue['prixTotal'] = round($sommePrix,2);

            for ($i = 0; $i < $length; $i++) {
                
                if ($subArray['deglaçageMp'][$i]) {
                    $cumulCuit += $subArray['poidMp'][$i] * 0.1012;
                }
                $calculeValue['poidRestant'] = $calculeValue['poidTotal'] - $cumulCuit;

                $eau += $raws[$i]->getH2o() * $subArray['poidMp'][$i] / 100;
                
                        
                if($raws[$i]->getDAlcool() != 0){
                    $alcoolPur += $raws[$i]->getDAlcool() * $subArray['poidMp'][$i] / 100;
                }

                if($raws[$i]->getCacao() != 0){
                    $cacaoDegraisse += $raws[$i]->getCacao() * $subArray['poidMp'][$i] / 100;
                }
                

                $gmgValues = [$raws[$i]->getQmg(), $raws[$i]->getQmg2(), $raws[$i]->getQmg3()];

                foreach ($gmgValues as $gmgValue) {
                    if ($gmgValue != 0) {
                        $cumulMatiereGrasse = $subArray['poidMp'][$i] * $gmgValue / 100;

                        $matiereGrasse += $cumulMatiereGrasse;

                    //$eau += $Matière_Première->Quantité_Eau * $Cumul_Matière_Grasse / 100;
                        if ($raws[$i]->getQmg() != 0) {
                            $matiereGrasse0_20 += $cumulMatiereGrasse;
                        } else if ($raws[$i]->getQmg2() != 0) {
                            $matiereGrasse21_32 += $cumulMatiereGrasse;
                        } else if ($raws[$i]->getQmg3() != 0 ) {
                            $matiereGrasse33Plus += $cumulMatiereGrasse;
                        }
                    }
                }
    
                $qsucValues = [$raws[$i]->getQsuc(), $raws[$i]->getQsuc2(), $raws[$i]->getQsuc3()];

                foreach ($qsucValues as $qsucValue) {
                    if ($qsucValue != 0) {
                        $eau += $raws[$i]->getH2o() * $subArray['poidMp'][$i] * $qsucValue / 10000;
                    }
                } 
                
                $totalParticipationMatierePremiere += $subArray['poidMp'][$i] / $calculeValue['poidTotal'];

                if($totalParticipationMatierePremiere > $raws[$i]->getPMaxi() &&  $raws[$i]->getPMaxi() > 0){
                    Erreur("Le produit a un pourcentage de participation trop important");

                }  else {

                    $matierePremiereParticipation = $totalParticipationMatierePremiere * 100;
                }
                    
               
                $matiereSeche += round($raws[$i]->getAutre1() * $subArray['poidMp'][$i] / $calculeValue['poidRestant'], 2 );
          
                $cumulAutre += round($raws[$i]->getAutre1() * $subArray['poidMp'][$i] / $calculeValue['poidRestant'] * $raws[$i]->getConv(), 2 );   

                $indiceSucrant += round($raws[$i]->getPsucre() * $subArray['poidMp'][$i] / $calculeValue['poidRestant'], 2 );
            

                if($raws[$i]->getQsuc() != 0){
                    $qSucre = $this->rawRepository->getRawById(262);
                    $cumulSucre +=  $qSucre->getAutre1() * $subArray['poidMp'][$i] * $raws[$i]->getQsuc() * $qSucre2->getConv() / (100 * $calculeValue['poidRestant']);
            
                }

                if($raws[$i]->getQsuc2() != 0){
                    $qSucre2 = $this->rawRepository->getRawById(327);
                    $cumulSucre +=  round($qSucre2->getAutre1() * $raws[$i]->getQsuc2() * $qSucre2->getConv() * $subArray['poidMp'][$i] / (100 * $calculeValue['poidRestant']),2);
                    
                }
                
                if($raws[$i]->getQsuc3() != 0){
                    $qSucre3 = $this->rawRepository->getRawById(480);
                    $cumulSucre +=  round($qSucre3->getAutre1() * $raws[$i]->getQsuc3() * $qSucre3->getConv() * $subArray['poidMp'][$i] / (100 * $calculeValue['poidRestant']),2);
        
                }
                                    

                if($raws[$i]->getQmg() != 0){
                    $qMg = $this->rawRepository->getRawById(263);
                    $cumulMg += round($qMg->getAutre1() * $subArray['poidMp'][$i] * $raws[$i]->getQmg() * $qMg2->getConv() / (100 * $calculeValue['poidRestant']) , 2);
                    
                }

                if($raws[$i]->getQmg2() != 0){
                    $qMg2 = $this->rawRepository->getRawById(264);
                    $cumulMg += round($qMg2->getAutre1() * $raws[$i]->getQmg2() * $qMg2->getConv() * $subArray['poidMp'][$i] / (100 * $calculeValue['poidRestant']),2);
                    
                }
                
                if($raws[$i]->getQmg3() != 0){
                    $qMg3 = $this->rawRepository->getRawById(265);
                    $cumulMg += round($qMg3->getAutre1() * $raws[$i]->getQmg3() * $qMg3->getConv() * $subArray['poidMp'][$i] / (100 * $calculeValue['poidRestant']),2);
                    
        
                }
                 $somme = $cumulAutre + $cumulMg + $cumulSucre ;
            }
            
           
            if ($eau < 12 && count($subArray['poidMp']) >= 5) {
                // $hre = $sans_hre;
            } else {
                // $hre = 0;
            }
       
        }
        $cumulAutre = $somme;
        $eau = $eau - $cumulCuit;
        $quantiteTotale = $calculeValue['poidTotal'];
        $quantiteTotaleRestante = $calculeValue['poidTotal'];
        
        if ($calculeValue['poidTotal'] && $quantiteTotaleRestante > 0 ){

            if ($quantiteTotaleRestante >= 15000){
                $poidPerte = 150;
            } 
            if($calculeValue['poidTotal'] < 15000 && $calculeValue['poidTotal'] >= 10000) {
                $poidPerte = 100;
            }
            if ($calculeValue['poidTotal'] < 10000 && $calculeValue['poidTotal'] >= 5000)  {
                $poidPerte = 80;
            }
            if ($calculeValue['poidTotal'] < 5000 && $calculeValue['poidTotal'] >= 3000)  {
                $poidPerte = 60;
            }
            if ($calculeValue['poidTotal'] < 3000 && $calculeValue['poidTotal'] >= 1000)  {
                $poidPerte = 40;
            }
            if ($calculeValue['poidTotal'] < 1000)  {
                $poidPerte = 30;
            }
            
        }

        $eau = $eau + ($calculeValue['poidTotal'] - $quantiteTotaleRestante);
        $quantiteTotaleRestante = $calculeValue['poidTotal'] + $poidPerte;

        $PrixAuKg = round(1000 * $calculeValue['prixTotal'] / $calculeValue['poidRestant'], 2 );
        $eau = round($eau/$calculeValue['poidRestant'] * 100, 2 );

        
        $matiereGrasse = round($matiereGrasse * 100 / $calculeValue['poidRestant'], 2 );
        $matiereGrasse0_20 = round($matiereGrasse0_20 * 100 / $calculeValue['poidRestant'], 2 );
        $matiereGrasse21_32 = round($matiereGrasse21_32 * 100 / $calculeValue['poidRestant'], 2 );
        $matiereGrasse33Plus = round($matiereGrasse33Plus * 100 / $calculeValue['poidRestant'], 2 );
        $alcoolPur = round($alcoolPur * 100 / $calculeValue['poidRestant'], 2 );
        $cacaoDegraisse = round($cacaoDegraisse * 100 / $calculeValue['poidRestant'],2 );
        
      


        $hre = $this->userRepository->queryHre($tableau[0]['userId']);
        $equiPerSac = $cumulAutre;

        if ($eau != 0) {

            $concentrationGrPerEau = $cumulAutre / $eau;
            $hrep = round($concentrationGrPerEau, 2 );
            $eshre =  $this->eshreRepository->getEshre($hrep);
            $hre_societe = $this->userRepository->queryHre($tableau[0]['userId']); 
            
            // $ecart = $hre - $hre_societe;
           
            $conservation = $this->conservationRepository->getConservationByHrAndHre($eshre , $hre);

            if (!isset($conservation)) {
                $conservation = 0;
            }
        } else {
            $ecart = 0;
            $hre = "Hors limite";
            $conservation = 0;
        }

        $matiereSeche = 100 - $eau;

       

        $conservationEcart = round($conservation * 0.05);

        
        //'12/20°C'
        if ($tableau[0]['tempRange'] == 3) {
            $dureeDeVieMinimum = ($conservation - $conservationEcart) . " - " . ($conservation + $conservationEcart);
        }

        //'4/12°C'
        else if ($tableau[0]['tempRange'] == 2 ) {
            $dureeDeVieMinimum = $conservation . " - " . ($conservation + 2 * $conservationEcart);
        }

        //'0/4°C'
        else if ($tableau[0]['tempRange'] == 1) {
            $dureeDeVieMinimum = ($conservation + 2 * $conservationEcart) . " + ";
        }
         
        // if ( $conservation > 120) {
        //     $dureeDeVieMinimum = "Hors limite";
        // }

        $calculeValue['eau'] = $eau;
        $calculeValue['PrixAuKg'] = $PrixAuKg;
        $calculeValue['alcoolPur'] = $alcoolPur;
        $calculeValue['matiereSeche'] = $matiereSeche;
        $calculeValue['matiereGrasse0_20'] = $matiereGrasse0_20;
        $calculeValue['matiereGrasse21_32'] = $matiereGrasse21_32;
        $calculeValue['matiereGrasse33Plus'] = $matiereGrasse33Plus;
        $calculeValue['matiereGrasseTotal'] = $matiereGrasse;
        $calculeValue['indiceSucrant'] = $indiceSucrant;
        $calculeValue['cacaoDegraisse'] = $cacaoDegraisse;
        $calculeValue['eshre'] = $eshre; 
        $calculeValue['dureeDeVieMinimum'] = $dureeDeVieMinimum; 
        $calculeValue['aw'] = $aw; 

       return $calculeValue;
    }

}