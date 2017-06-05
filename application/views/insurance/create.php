<input type="hidden" name="accountID" id="accountID" value="<?php echo $accountID?>">
<div class="insurance uk-container uk-container-center uk-margin-top uk-margin-large-bottom">
    <div class="uk-grid" data-uk-grid-margin="">
        <div class="uk-width-medium-1-1">
            <header class="uk-grid">
                <div class="uk-width-1-3">
                    <img src="<?php echo base_url();?>public/img/cpic.png" alt="CPIC" class="cpic-log"/>
                </div>
                <div class="uk-width-2-3">
                    <p>【太平洋保险】旅游安全人身意外伤害保险</p>
                    <p class="uk-text-danger">密点：<i class="totalMecoin">500 — 1800</i></p>
                </div>
            </header>
            <section class="uk-grid">
                <div class="uk-width-1-1 uk-form-row">
                    <h3 class="tm-article-subtitle">保障方案</h3>
                    <div data-uk-button-radio class="data-uk-button-radio">
                        <button class="uk-button uk-active">个人投保</button>
                    </div>
                </div>
                <div class="uk-width-1-1 uk-form-row">
                    <h3 class="tm-article-subtitle">保险期间</h3>
                    <div data-uk-button-radio class="data-uk-button-radio">
                        <button class="uk-button uk-active deadline" data-type="1">10天</button>
                        <button class="uk-button deadline" data-type="2">20天</button>
                    </div>
                </div>
                <div class="uk-width-1-2 uk-form-row">
                    <h3 class="tm-article-subtitle">成人数量</h3>
                    <div class="insurance-count">
                        <i class="uk-icon-minus subtractCount"></i><input type="number" min="0" disabled id="adultCount" value="0" data-type="1"><i class="uk-icon-plus addCount"></i>
                    </div>
                </div>
                 <div class="uk-width-1-2 uk-form-row" id='minorCountone'>    
                    <h3 class="tm-article-subtitle">未成年人数量</h3>
                    <div class="insurance-count">
                        <i class="uk-icon-minus subtractCount"></i><input type="number" min="0" disabled id="minorCount" value="0" data-type="2"><i class="uk-icon-plus addCount"></i>
                    </div>
                </div>
            </section>
            <hr />
            <footer>
                <button class="uk-button uk-button-danger uk-button-large uk-width-1-1" type="button" id="create">创建保单</button>
            </footer>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url();?>public/js/juicer-min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public/js/store-insure.js"></script>
