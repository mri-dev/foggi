<div class="account page-width">
    <div class="grid-layout">
        <div class="grid-row grid-row-20"><? $this->render('user/inc/account-offline', true); ?></div>
        <div class="grid-row grid-row-80">
          <div class="">
            <h1><?=($_GET['group'] == 'partner')?'Partner regisztráció':'Regisztráció'?></h1>
                <?=$this->msg?>
                <form action="/user/regisztracio/<?=($_GET['group'] == 'partner')?'?group=partner':''?>" method="post" id="register" onsubmit="$('#registerBtn').click() return false;">
                <input type="hidden" name="group" value="<?=($_GET['group'] == 'partner')?'partner':'user'?>">
                <div class="" style="padding:0;">
                    <div class="stack">
                        <h3>Alapadatok</h3>
                        <div>
                            <div class="row">
                                <div class="col-md-6 col-pright"><label for="nev">Teljes név:</label><input required="required" type="text" id="nev" name="nev" value="<?=($this->msg)?$_POST['nev']:''?>" class="form-control"/></div>
                                <div class="col-md-6 col-pleft"><label for="email">E-mail cím:</label><input required="required" type="text" id="email" name="email" value="<?=($this->msg)?$_POST['email']:''?>" class="form-control <?=($this->err == 1002)?'input-text-error':''?>" excCode="1002" /></div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-pright"><label for="pw1">Jelszó</label><input required="required" type="password" id="pw1" name="pw1" class="form-control"/></div>
                                <div class="col-md-6 col-pleft"><label for="pw2">Jelszó újra</label><input required type="password" id="pw2" name="pw2" class="form-control"/></div>
                            </div>
                        </div>
                    </div>
                    <? if($_GET['group'] == 'partner'): ?>
                    <div class="stack">
                        <h3>Cégadatok</h3>
                        <div>
                            <div class="row">
                                <div class="col-md-6 col-pright"><label for="company_name">Cégnév:</label><input required="required" type="text" id="company_name" name="reseller[company_name]" value="<?=($this->msg)?$_POST['reseller']['company_name']:''?>" class="form-control <?=($this->err == 2001)?'input-text-error':''?>" excCode="2001"/></div>
                                <div class="col-md-6 col-pleft"><label for="company_hq">Cég székhelye:</label><input required="required" type="text" id="company_hq" name="reseller[company_hq]" value="<?=($this->msg)?$_POST['reseller']['company_hq']:''?>" class="form-control <?=($this->err == 2002)?'input-text-error':''?>" excCode="2002" /></div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-pright"><label for="company_adoszam">Adószám:</label><input required="required" type="text" id="company_adoszam" name="reseller[company_adoszam]" value="<?=($this->msg)?$_POST['reseller']['company_adoszam']:''?>" class="form-control <?=($this->err == 2003)?'input-text-error':''?>" excCode="2003"/></div>
                                <div class="col-md-6 col-pleft"><label for="company_address">Cég postacím:</label><input required="required" type="text" id="company_address" name="reseller[company_address]" value="<?=($this->msg)?$_POST['reseller']['company_address']:''?>" class="form-control <?=($this->err == 2004)?'input-text-error':''?>" excCode="2004" /></div>
                            </div>
                        </div>
                    </div>
                    <? endif; ?>
                    <div class="stack">
                        <h3>Vásárláshoz szükséges adatok</h3>
                        <div>
                            <div class="row">
                                <div class="col-md-6 col-pright">
                                    <h4>Számlázási adatok</h4>
                                    <div class="row">
                                        <div class="col-md-4 form-text"><strong>Név</strong></div>
                                        <div class="col-md-8"><input required="required" type="text" id="szam_nev" name="szam_nev" class="form-control"/></div>
                                    </div>  
                                    <div class="divider-sm"></div>
                                    <div class="row">
                                        <div class="col-md-4 form-text"><strong>Utca, házszám</strong></div>
                                        <div class="col-md-8"><input required="required" type="text" id="szam_uhsz" name="szam_uhsz" class="form-control"/></div>
                                    </div>
                                    <div class="divider-sm"></div>
                                    <div class="row">
                                        <div class="col-md-4 form-text"><strong>Város</strong></div>
                                        <div class="col-md-8"><input required="required" type="text" id="szam_city" name="szam_city" class="form-control"/></div>
                                    </div>
                                    <div class="divider-sm"></div>
                                    <div class="row">
                                        <div class="col-md-4 form-text"><strong>Irányítószám</strong></div>
                                        <div class="col-md-8"><input required="required" type="text" id="szam_irsz" name="szam_irsz" class="form-control"/></div>
                                    </div>
                                    <div class="divider-sm"></div>
                                    <div class="row">
                                        <div class="col-md-4 form-text"><strong>Megye</strong></div>
                                        <div class="col-md-8">
                                            <select name="szam_state" class="form-control" id="szam_state">
                                                <option value="" selected="selected">-- válasszon --</option>
                                                <option value="" disabled="disabled"></option>
                                                <? foreach( $this->states as $s ): ?>
                                                    <option value="<?=$s?>"><?=$s?></option>
                                                <? endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="divider-sm"></div>
                                    <div class="row">
                                        <div class="col-md-12 form-text right" style="font-size:0.85em;"><a href="javascript:void(0);" id="copySzamToSzall">számlázási adatok másolása szállítási adatokhoz <i class="fa fa-arrow-right"></i> </a></div>
                                        
                                    </div>
                                    
                                </div>
                                <div class="col-md-6 col-pleft">
                                    <h4>Szállítási adatok</h4>
                                    <div class="row">
                                        <div class="col-md-4 form-text"><strong>Név</strong></div>
                                        <div class="col-md-8"><input required="required" type="text" id="szall_nev" name="szall_nev" class="form-control"/></div>
                                    </div>  
                                    <div class="divider-sm"></div>
                                    <div class="row">
                                        <div class="col-md-4 form-text"><strong>Utca, házszám</strong></div>
                                        <div class="col-md-8"><input required="required" type="text" id="szall_uhsz" name="szall_uhsz" class="form-control"/></div>
                                    </div>
                                    <div class="divider-sm"></div>
                                    <div class="row">
                                        <div class="col-md-4 form-text"><strong>Város</strong></div>
                                        <div class="col-md-8"><input required="required" type="text" id="szall_city"  name="szall_city" class="form-control"/></div>
                                    </div>
                                    <div class="divider-sm"></div>
                                    <div class="row">
                                        <div class="col-md-4 form-text"><strong>Irányítószám</strong></div>
                                        <div class="col-md-8"><input required="required" type="text" id="szall_irsz" name="szall_irsz" class="form-control"/></div>
                                    </div>                                
                                    <div class="divider-sm"></div>
                                    <div class="row">
                                        <div class="col-md-4 form-text"><strong>Megye</strong></div>
                                        <div class="col-md-8">
                                            <select name="szall_state" class="form-control" id="szall_state">
                                                <option value="" selected="selected">-- válasszon --</option>
                                                <option value="" disabled="disabled"></option>
                                                <? foreach( $this->states as $s ): ?>
                                                    <option value="<?=$s?>"><?=$s?></option>
                                                <? endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="divider-sm"></div>
                                    <div class="row">
                                        <div class="col-md-4 form-text"><strong>Telefonszám</strong></div>
                                        <div class="col-md-8"><input required="required" type="text" id="szall_phone" name="szall_phone" class="form-control"/></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="stack">                    
                        <div class="row">
                            <div class="col-md-8 form-btn" style="line-height:42px;font-size: 0.8em;"><input required="required" type="checkbox" id="aszfOk" name="aszfOk" /> <label for="aszfOk">Elolvastam és tudomásul vettem az <a href="<?=$this->settings['ASZF_URL']?>" target="_blank">ÁSZF</a>-ben foglaltakat!</label></div>
                            <div class="col-md-4" align="right">
                                <button name="registerUser" value="1" class="btn btn-pr">Regisztráció <i class="fa fa-arrow-circle-right"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>  
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function(){        
        $('#copySzamToSzall').click(function(){
            $('#register input[name^=szam_]').each(function(){
                var e = $(this).attr('name');
                 $('#register input[name=szall_'+e.replace('szam_','')+']').val($(this).val()); 
            }); 
            $('#register select#szall_state option[value="'+$('#register select#szam_state').val()+'"]').prop('selected', true);
        });
    })
</script>


