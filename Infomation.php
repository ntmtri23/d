@{
    Layout = "";
}
@model RewardClient.Models.ClientInfomationViewModel

<script type="text/javascript">
    var luckyDrawId = $("#lkdid").val();
    $('.save-data').click(function () {
        var phoneNumber = $("#PhoneNumber1").val();
        var email = $("#Email1").val();
        var address = $("#Address1").val();
        var username = $('#UserName').val();
        var url = "/LuckyDraw/SaveInfomation"
        $.ajax({
            type: 'GET',
            url: url,
            data: 'UserName=' + username + '&PhoneNumber1=' + phoneNumber + '&Email1=' + email + "&Address1=" + address,
            success: function (response) {
                if (response == "1")
                {
                    $.fancybox.close();
                    startSpin('undefined', luckyDrawId);
                }
            },
            error: function () {
            }
        });
    });
</script>

<div class="panel-body">
    <div class="example-box-wrapper">
        <form class="form-horizontal bordered-row" style="width:500px;">
            <fieldset>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Tên c?a b?n</label>
                    <div class="col-sm-8">
                        <input type="text" name="UserName" id="UserName" placeholder="Nh?p tên c?a b?n" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Ði?n tho?i</label>
                    <div class="col-sm-8">
                        <input type="text" name="PhoneNumber" id="PhoneNumber" placeholder="Nh?p di?n tho?i" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Email</label>
                    <div class="col-sm-8">
                        <input type="text" name="Email" id="Email" placeholder="Nh?p tên c?a b?n" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Ð?a ch?</label>
                    <div class="col-sm-8">
                        <input type="text" name="Address" id="Address" placeholder="Nh?p tên c?a b?n" />
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4" style="text-align:right;">
                        &nbsp;
                    </div>
                    <div class="col-sm-6">
                        <button class="btn btn-success save-data" type="button">Luu</button>
                    </div>
                </div>
            </fieldset>
        </form>
        <input type="hidden" value="@Model.LuckyDrawId" id="lkdid" />
    </div>
</div>
