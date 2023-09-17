<script>
    //special Offers
    $("body").on("click", ".btn-create-specialOffers", function() {
        var html = `
        <div class="row pt-1 option-section">
            <div class="options-list-place">
                <div class="row  options-list">
                    <div class="col-12 col-sm-3 mb-1">
                        <label class="form-label" for="specialOfferPercentage">{{trans('common.Percentage')}}</label>
                        <input type="number" name="specialOfferPercentage[]" id="specialOfferPercentage"
                            class="form-control option-specialOfferPercentage" min=0
                            onchange="checkDiscountPrice(this)"
                            onkeydown="checkDiscountPrice(this)"
                            onkeypress="checkDiscountPrice(this)"
                            onkeyup="checkDiscountPrice(this)">
                    </div>
                    <div class="col-12 col-sm-3 mb-1">
                        <label class="form-label" for="specialOfferStartDate">{{trans('common.startDate')}}</label>
                        <input type="date" name="specialOfferStartDate[]" id="specialOfferStartDate"
                            class="form-control option-specialOfferStartDate" min=0
                            onchange="checkDiscountDate(this)"
                            onkeydown="checkDiscountDate(this)"
                            onkeypress="checkDiscountDate(this)"
                            onkeyup="checkDiscountDate(this)"
                            min=date('Y-m-d')
                            max=date('Y-m-d', strtotime('+1 year'))>
                    </div>
                    <div class="col-12 col-sm-3 mb-1">
                        <label class="form-label" for="specialOfferEndDate">{{trans('common.endDate')}}</label>
                        <input type="date" name="specialOfferEndDate[]" id="specialOfferEndDate"
                            class="form-control option-specialOfferEndDate" min=0
                            onchange="checkDiscountDate(this)"
                            onkeydown="checkDiscountDate(this)"
                            onkeypress="checkDiscountDate(this)"
                            onkeyup="checkDiscountDate(this)"
                            min=date('Y-m-d')
                            max=date('Y-m-d', strtotime('+1 year'))>
                    </div>
                    <div class="col-12 col-sm-1 col-sm-1">
                        <div class="btn btn-danger mt-1 me-1 btn-delete-option">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-trash" viewBox="0 0 16 16">
                                <path
                                    d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                <path fill-rule="evenodd"
                                    d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        `;
        $('.specialOffers-section').append(html);
        });
        $("body").on("click", ".btn-delete-option", function() {
        $(this).parent().parent().remove();
        });
</script>
