<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Settings</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="rmActive()"></button>
            </div>
            <div class="modal-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item list-group-item-dark" diabled>Language</li>
                </ul>
                <?php
                include "../Language/language.php"
                ?>
<!--                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-6 langSelect" style="text-align: center; padding:20px; background:var(--sec-color);">
                                    English
                                </div>
                                <div class="col-sm-6 langSelect" style="text-align: center; padding:20px;">
                                    中文
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 langSelect" style="text-align: center; padding:20px;">
                                    Behasa Melayu
                                </div>
                                <div class="col-sm-6 langSelect" style="text-align: center; padding:20px;">
                                    தமிழ்
                                </div>
                            </div>
                        </div>
                    </div>
                </div>-->

                <ul class="list-group list-group-flush">
                    <!--                    <li class="list-group-item list-group-item-dark" diabled>Language</li>
                                        <li class="list-group-item">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="english" checked>
                                            <label class="form-check-label" for="english">
                                                English
                                            </label>
                                        </li>
                                        <li class="list-group-item">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="chinese">
                                            <label class="form-check-label" for="chinese">
                                                中文
                                            </label>
                                        </li>
                                        <li class="list-group-item">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="malay">
                                            <label class="form-check-label" for="malay">
                                                Behasa Melayu
                                            </label>
                                        </li>
                                        <li class="list-group-item">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="tamil">
                                            <label class="form-check-label" for="tamil">
                                                தமிழ்
                                            </label>
                                        </li>-->
                    <li class="list-group-item list-group-item-dark" diabled>Audio Cues</li>
                    <li class="list-group-item">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="soundon" checked>
                        <label class="form-check-label" for="soundon">
                            Turn on
                        </label>
                    </li>
                    <li class="list-group-item">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="soundoff">
                        <label class="form-check-label" for="soundoff">
                            Turn off
                        </label>
                    </li>
                </ul>

            </div>
        </div>
    </div>
</div>

<script>
    var lang = "english";

    function rmActive() {
        $("ul").find(".active").removeClass("active");
    }
    ;

    $(".langSelect").click(function () {
        $(".langSelect").css({'background': 'none'});
        $(this).css({'background': 'var(--sec-color)'});
    });
</script>