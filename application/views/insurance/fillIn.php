<div class="insurance uk-container uk-container-center uk-margin-top uk-margin-large-bottom">
    <div class="uk-grid" data-uk-grid-margin="">
        <div class="uk-width-medium-1-1">
            <header class="uk-grid">
                <p>【太平洋保险】旅游安全人身意外伤害保险</p>
            </header>
            <section>
                <ul class="uk-list uk-list-striped uk-width-medium-1-1 applicant-info">
					<li>
                        <label>保险期间</label>
                        <span id="insurePeriod"><?php echo $insurePeriod; ?></span>
                        <input type="hidden" name="insurePeriod" value="<?php echo $insurePeriod; ?>">
                    </li>
					<li>
                        <label for="">保障方案</label>
                        <span>个人投保</span>
                    </li>
					<li>
                        <label for="">份数</label>
                        <span id="amount"><?php echo $amount; ?></span>
                        <input type="hidden" name="amount" value="<?php echo $amount; ?>">
                        <input type="hidden" name="adultCount" value="<?php echo $adultCount; ?>">
                        <input type="hidden" name="minorCount" value="<?php echo $minorCount; ?>">
                    </li>
					<li>
                        <label for="">保费</label>
                        <span id="premium"><?php echo $totalMecoin; ?>密点</span>
                        <input type="hidden" name="mecoin" value="<?php echo $totalMecoin; ?>">
                    </li>
                </ul>
            </section>
            <section id="applicant">
                <h3 class="tm-article-subtitle">投保人信息</h3>
                <ul class="uk-list uk-list-striped uk-width-medium-1-1 applicant-info">
                    <li>
                        <label>姓名</label>
                        <input type="text" name="insureName" id="insureName" data-type="name" placeholder="请填写投保人姓名">
                        <input type="hidden" name="accountID" id="accountID" value="<?php echo $accountID?>">
                    </li>
                    <li>
                        <label for="">证件类型</label>
                        <span>身份证</span>
                    </li>
                    <li>
                        <label for="">证件号码</label>
                        <input type="text" name="insureIDCard" id="insureIDCard" data-type="IDCard" placeholder="请填写投保人身份证号码">
                    </li>
                    <li>
                        <label for="">手机号码</label>
                        <input type="number" name="insurePhone" id="insurePhone" data-type="phone" placeholder="请填写投保人手机号">
                    </li>
                </ul>
            </section>
            <?php for ($i=0; $i < $adultCount; $i++) { ?>
                <section class="adultInfo">
                    <form>
                    <h3 class="tm-article-subtitle">被保险人信息<?php echo $i+1;?> </h3>
                    <ul class="uk-list uk-list-striped uk-width-medium-1-1 applicant-info">
                       <li>
                            <label>姓名</label>
                            <input type="text" name="insuredName" data-type="name" placeholder="请填写被保险人姓名">
                        </li>
                        <li>
                            <label for="">是否成年</label>
                            <span>是</span>
                        </li>
                        <li>
                            <label for="">证件类型</label>
                            <span>身份证</span>
                        </li>
                        <li>
                            <label for="">证件号码</label>
                            <input type="text" name="insuredIDCard" data-type="IDCard" placeholder="请填写被保险人身份证号码">
                        </li>
                        <li>
                            <label for="">受益人</label>
                            <span>法定受益人</span>
                        </li>
                    </ul>
                    </form>
                </section>
            <?php } ?>
             <?php for ($i=0; $i < $minorCount; $i++) { ?>
                <section class="minorInfo">
                    <form>
                    <h3 class="tm-article-subtitle">被保险人信息<?php echo $i+1;?></h3>
                    <ul class="uk-list uk-list-striped uk-width-medium-1-1 applicant-info">
                        <li>
                            <label>姓名</label>
                            <input type="text" name="insuredName" id="" data-type="name" placeholder="请填写被保险人姓名">
                        </li>
                        <li>
                            <label for="">是否成年</label>
                            <span>否</span>
                        </li>
                        <li>
                            <label for="">出生日期</label>
                            <input type="date" data-type="date" name="insuredBirthdate">
                        </li>
                        <li>
                            <label for="">性别</label>
                            <input type="radio" value="0" name="insuredGender" checked> 男
                            <input type="radio" value="1" name="insuredGender" > 女
                        </li>
                        <li>
                            <label for="">受益人</label>
                            <span>法定受益人</span>
                        </li>
                    </ul>
                    </form>
                </section>
            <?php } ?>      
            <hr />
            <h4 class="uk-text-danger" id="title"></h4>         
            <footer>
                <input type="checkbox" name="" id="agreement" checked>
            本人已经认真阅读保险条款，尤其是免除保险人责任的规定，没有异议，申请投保。本人知晓所有保险责任均以本保险合同所载为准。
                <button class="uk-button uk-button-danger uk-button-large uk-width-1-1" type="button" id="submit">提交保单</button>
            </footer>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url();?>public/js/juicer-min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public/js/store-insure.js"></script>
