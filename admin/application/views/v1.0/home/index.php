<? if($this->adm->logged): ?>
<div class="alert-board">
    <? if( count( $this->unused_images ) > 0): ?>
    <div class="item">
        <div class="head"><?=count( $this->unused_images )?> db használaton kívüli termékkép</div>
        <div class="sl"><a href="/beallitasok/clearimages">képek megtekintéséhez ide kattintson</a></div>
    </div>
    <? endif; ?>
</div>
<h1>Dashboard</h1>
<div class="clr"></div>
<br>
	<? if(true): ?>
    	<div class="row">
        	<div class="col-md-3">
            	<div class="box red">
                	<div class="head">
                    	<div class="btn"><a href="/megrendelesek/"><i class="fa fa-arrow-circle-right"></i></a></div>
                    	<div class="n"><?=$this->stats[orders][news][db]?></div> 
                        <div class="txt">
                        	<div>új megrendelés</div>
                            <div>még nem feldolgozott</div>
                        </div>
                    </div>
                    <div class="c">
                    	<? if($this->stats[orders][news][db] > 0): ?>
                    	<div class="row">
                        	<div class="col-md-3"><strong><?=Helper::cashFormat($this->stats[orders][news][ar])?> FT</strong></div>
                            <div class="col-md-9 title">össz. értékben</div>
                        </div>
                        <div class="row">
                        	<div class="col-md-3"><strong><?=$this->stats[orders][news][tetel]?> DB</strong></div>
                            <div class="col-md-9 title">össz. tétel</div>
                        </div>
                        <? else: ?>
                        <div class="noItem">
                        	Nincs feldolgozatlan megrendelés
                       	</div>
                        <? endif; ?>
                    </div>
                </div>
                <div class="box orange">
                    <div class="head">
                        <div class="btn"><a href="/megrendelesek/"><i class="fa fa-arrow-circle-right"></i></a></div>
                        <div class="n"><?=$this->stats[orders][progress][db]?></div> 
                        <div class="txt">
                            <div>megrendelés</div>
                            <div>folyamatban</div>
                        </div>
                    </div>
                    <div class="c">
                        <div class="row">
                            <div class="col-md-3"><strong><?=Helper::cashFormat($this->stats[orders][progress][ar])?> FT</strong></div>
                            <div class="col-md-9 title">össz. értékben</div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"><strong><?=$this->stats[orders][progress][tetel]?> DB</strong></div>
                            <div class="col-md-9 title">össz. tétel</div>
                        </div>
                    </div>
                </div>
                <div class="box blue">
                    <div class="head">
                        <div class="btn"><a href="/felhasznalok/"><i class="fa fa-arrow-circle-right"></i></a></div>
                        <div class="n"><?=number_format($this->stats[users][regInThisMonth],0,"",",")?></div> 
                        <div class="txt">
                            <div>új felhasználó</div>
                            <div>ebben a hónapban</div>
                        </div>
                    </div>
                    <div class="c">
                        <div class="row">
                            <div class="col-md-3"><strong><?=number_format($this->stats[users][loginInThisWeek],0,"",",")?> DB</strong></div>
                            <div class="col-md-9 title">belépett az elmúlt héten</div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"><strong><?=number_format($this->stats[users][activated],0,"",",")?> DB</strong></div>
                            <div class="col-md-9 title">aktivált felhasználó</div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"><strong><?=number_format($this->stats[users][total],0,"",",")?> DB</strong></div>
                            <div class="col-md-9 title">összesen</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <? if(true): ?>
                <div class="box blue">
                    <div class="head">
                        <div class="btn"><a href="/referrerHierarchy"><i class="fa fa-arrow-circle-right"></i></a></div>
                        <div class="txt">
                            <div><strong>ajánló</strong> rangsor</div>
                            <div>Az elmúlt 30 nap eredménye ( <?=$this->refusers[info][input][arg][referertime][from]?> &mdash; )</div>
                        </div>
                    </div>
                    <div class="c">
                       <? if(count($this->refusers[data]) > 0): ?>
                        <? foreach( $this->refusers[data] as $u ): ?>
                        <div class="row">
                            <div class="col-md-4">
                                <strong><?=$u['nev']?></strong> <br>
                                <em><?=$u['email']?></em>
                            </div>
                            <div class="col-md-4">
                                <strong><?=Helper::cashFormat($u['totalRefererOrderNum'])?> db</strong><br>
                                megrendelés
                            </div>
                            <div class="col-md-4">
                                 <strong><a target="_blank" title="Megrendelések listája" href="/partnerSale?partner=<?=$u[total_data][data][refererID]?>"><?=Helper::cashFormat($u['totalReferredOrderPrices'])?> Ft</a></strong><br>
                                 össz. értékben  
                            </div>
                        </div>
                        <? endforeach; ?>
                       <? else: ?>
                        <div class="noItem">
                            Nincs adat
                        </div>
                       <? endif; ?>
                    </div>
                </div>
                <? endif; ?>                
            </div>
            <div class="col-md-6">
                <? if(true): ?>
                <div class="box green">
                    <div class="head">
                        <div class="n"><?=count($this->stats[lastMessages][data])?></div>
                        <div class="btn"><a href="/uzenetek"><i class="fa fa-arrow-circle-right"></i></a></div>
                        <div class="txt">
                            <div><strong>beérkezett</strong> üzenet</div>
                            <div>interakcióra vár</div>
                        </div>
                    </div>
                    <div class="c">
                        <? if(count($this->stats[lastMessages][data]) > 0): ?>
                        <? foreach($this->stats[lastMessages][data] as $d): ?>
                        <div class="row">
                            <div class="col-md-2">
                                <?=$d[felado_nev]?>
                            </div>
                            <div class="col-md-4">
                                <a href="/uzenetek/msg/<?=$d[ID]?>"><strong>
                                <span>
                                <?
                                    switch($d[tipus]){
                                        case 'recall':
                                            echo '<i style="width:15px;" class="fa fa-phone"></i>';
                                        break;
                                        case 'contactMsg':
                                            echo '<i style="width:15px;" class="fa fa-envelope-o"></i>';
                                        break;
                                        case 'requestAsk':
                                            echo '<i style="width:15px;" class="fa fa-question"></i>';
                                        break;
                                    }
                                ?>
                                </span>
                                <?=$d[uzenet_targy]?></strong></a>
                            </div>
                            <div class="col-md-3 center" style="font-size:12px;">
                                <?=\PortalManager\Formater::dateFormat($d[elkuldve], $this->settings['date_format'])?> (<?=Helper::distanceDate($d[elkuldve])?>)
                            </div>
                            <div class="col-md-3 right">
                                <? if($d[item_id]): ?>
                                    <strong><?=$d[item_nev]?></strong>
                                <? endif; ?>
                            </div>
                        </div>
                        <? endforeach; ?>
                        <? else: ?>
                            <div class="noItem">
                                Nincs új üzenet!
                            </div>
                        <? endif; ?>
                    </div>
                </div>
                <? endif; ?>
            </div>            
        </div>
        <br />
        <div class="row">
        	 <div class="col-md-3">
            	<div class="box">
                	<div class="head">
                    	<div class="btn"><a title="Teljes lista megtekintése" href="/stat/termek"><i class="fa fa-arrow-circle-right"></i></a></div>
                        <div class="txt">
                        	<div><h4><strong>TERMÉK NÉZETTSÉG</strong> STATISZTIKA</h4></div>
                        </div>
                    </div>
                    <div class="c">
                    	<? foreach($this->stats[termekView][data] as $d): ?>
                         <div class="row">
                        	<div class="col-md-3"><strong><?=$d[me]?></strong> <span title="Oldal betöltés / Megjelenés">AV</span></div>
                            <div class="col-md-9 title">
                                <strong><a href="/termekek/t/edit/<?=$d[termekID]?>"><?=$d[nev]?></a></strong> &nbsp; <a href="<?=HOMEDOMAIN.'termek/'.\PortalManager\Formater::makeSafeUrl($d['nev'],'_-'.$d['termekID'])?>" target="_blank" style="color:black;" title="Publikus adatlap"><i class="fa fa-external-link"></i></a>
                                <div class="stat-feat-info"> <span title="cikkszám">#<?=$d['cikkszam']?></span> &nbsp;&nbsp; <?=($d['meret'])? '<span class="text">Méret:</span> '.$d['meret'] :'' ?>  <?=($d['szin'])? '<span class="text">Szín:</span> '.$d['szin'] :'' ?> </div> 
                            </div>
                        </div>
                        <? endforeach; ?>
                        <div class="divider"></div>
                        <div class="row">
                        	<div class="col-md-12">
                            	<strong><?=$this->stats[termekView][total]?> db</strong> termék érdekelt ebben a hónapban.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        	<div class="col-md-3">
            	<div class="box">
                	<div class="head">
                    	<div class="btn"><a title="Teljes lista megtekintése"  href="/stat/kereses"><i class="fa fa-arrow-circle-right"></i></a></div>
                        <div class="txt">
                        	<div><h4><strong>TERMÉK KERESÉS</strong> STATISZTIKA</h4></div>
                        </div>
                    </div>
                    <div class="c">
                    	<? foreach($this->stats[search][data] as $d): ?>
                         <div class="row">
                        	<div class="col-md-3"><strong><?=$d[me]?>x</strong></div>
                            <div class="col-md-9 title"><?=$d[szoveg]?></div>
                        </div>
                        <? endforeach; ?>
                        <div class="divider"></div>
                        <div class="row">
                        	<div class="col-md-12">
                            	<strong><?=$this->stats[search][total]?> db</strong> keresési kulcsszó összesen ebben a hónapban.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3">
            	<div class="box">
                	<div class="head">
                    	<div class="btn"><a title="Teljes lista megtekintése"  href="/stat/kategoria"><i class="fa fa-arrow-circle-right"></i></a></div>
                        <div class="txt">
                        	<div><h4><strong>KATEGÓRIA NÉZETTSÉG</strong> STATISZTIKA</h4></div>
                        </div>
                    </div>
                    <div class="c">
                    	<? foreach($this->stats[kategoria][data] as $d): ?>
                         <div class="row">
                        	<div class="col-md-3"><strong><?=$d[me]?></strong> <span title="Oldal betöltés / Megjelenés">AV</span></div>
                            <div class="col-md-9 title"><a target="_blank" href="http://www.<?=str_replace(array('www.','http://'),'',rtrim($this->settings['page_url'],'/')).'/termekek/'.\PortalManager\Formater::makeSafeUrl($d['kategoriaNev'],'_-'.$d['kategoriaID'])?>"><?=$d['kategoriaNev']?></a></div>
                        </div>
                        <? endforeach; ?>
                        <div class="divider"></div>
                        <div class="row">
                        	<div class="col-md-12">
                            	<strong><?=$this->stats[kategoria][total]?> db</strong> kategória érdekelt ebben a hónapban.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                 <div class="box red">
                    <div class="head">
                        <div class="btn"><a href="/forgalom"><i class="fa fa-arrow-circle-right"></i></a></div>
                        <div class="txt">
                            <div><h4><strong>FORGALOM</strong> ADATOK</h4></div>
                        </div>
                    </div>
                    <div class="c traffic-info" style="padding:0;">
                        <div class="box-head">Ebben a hónapban</div>
                        <div class="row clear">
                            <div class="col-md-6" style="border-right:1px solid #ddd;" align="center">
                                <div class="traffic-price price-income">
                                    <?
                                        $x1 = $this->tafficInfo[latest][in];
                                        $x2 = $this->tafficInfo[latest][out];
                                    ?>
                                    <div class="stat <?=($x2 < $x1)?'p':'n'?>"><span><?=Helper::getPercent($x1,$x1-$x2)?>%</span></div>
                                    <div class="price"><span><?=Helper::cashFormat($x1)?></span></div>
                                    <div class="txt">bevétel</div>
                                </div>
                            </div>
                            <div class="col-md-6" align="center">
                                <div class="traffic-price price-outgo">
                                    <div class="price"><span><?=Helper::cashFormat($x2)?></span></div>
                                    <div class="txt">kiadás</div>
                                </div>
                            </div>
                        </div>
                        <div class="divider clear"></div>
                        <?
                            $x1 = $this->tafficInfo[all][in];
                            $x2 = $this->tafficInfo[all][out];
                        ?>
                        <div class="box-head">Összesen</div>
                        <div class="row clear">
                            <div class="col-md-6" style="border-right:1px solid #ddd;"  align="center">
                                <div class="traffic-price price-income">
                                    <div class="stat <?=($x2 < $x1)?'p':'n'?>"><span><?=Helper::getPercent($x1,$x1-$x2)?>%</span></div>
                                    <div class="price"><span><?=Helper::cashFormat($x1)?></span></div>
                                    <div class="txt">bevétel</div>
                                    
                                </div>
                            </div>
                            <div class="col-md-6"  align="center">
                                <div class="traffic-price price-outgo">
                                    <div class="price"><span><?=Helper::cashFormat($x2)?></span></div>
                                    <div class="txt">kiadás</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                
            </div>
           
        </div>
        <br />
        <div class="row">
			 <div class="col-md-8">
				
			</div>
        	<? if(true): ?>
            <div class="col-md-4">
           
            </div>
            <? endif; ?>
        </div>
    <? endif; ?>
<? endif;?>