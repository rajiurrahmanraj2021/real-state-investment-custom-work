$(document).on('click', '.investNow', function () {
    var propertyInvestModal = new bootstrap.Modal(document.getElementById('investNowModal'))
    propertyInvestModal.show();

    let dataRoute = $(this).data('route');
    let property = $(this).data('property');
    let dataProperty = property.details.property_title;
    let returnTimes = property.how_many_times;
    let dataInvestType = property.is_invest_type;
    let dataInvest = property.investmentAmount;
    let dataFixedAmount = property.fixed_amount;
    let dataMinimumAmount = property.minimum_amount;
    let dataProfit = property.profit;
    let dataProfitType = property.profit_type;
    let dataPeriod = property.managetime.time;
    let dataPeriodType = property.managetime.time_type;
    let isInstallment = property.is_installment;
    let totalInstallments = property.total_installments;
    let installmentAmount = property.installment_amount;
    let installmentDuration = property.installment_duration + ' ' + property.installment_duration_type;
    let installmentLateFee = property.installment_late_fee;
    let symbol = $(this).data('symbol');
    let currency = $(this).data('currency');

    $('.show-currency').text(currency);

    $('.invest_now_modal').attr('action', dataRoute);
    $('.property-title').text(`Property: ${dataProperty}`);
    $('.data_profit').text(`${(dataProfitType == '1') ? `${dataProfit}%` : `${symbol}${dataProfit}`}`);
    $('.data_invest').text(dataInvest);


    if (returnTimes == null) {
        let data = dataPeriod + ' ' + dataPeriodType;
        $('.data_return').text(data);
        $('.data_return').text(`${data} (Lifetime)`);
    } else {
        let data = dataPeriod + ' ' + dataPeriodType;
        $('.data_return').text(`${data} (${returnTimes} times)`);
    }


    if (dataInvestType == 1) {
        $('.invest-amount').val(dataMinimumAmount);
        $('#amount').attr('readonly', false);
    } else if(dataInvestType == 0){
        $('.invest-amount').val(dataFixedAmount);
        $('#amount').attr('readonly', true);
    }

    if (isInstallment == 1) {
        $('.totalInstallment').removeClass('d-none');
        $('.total_installment').text(totalInstallments);
        $('.installmentDuration').removeClass('d-none');
        $('.installment_duration').text(installmentDuration);
        $('.installmentLateFee').removeClass('d-none');
        $('.installment_late_fee').text(`${symbol}${installmentLateFee}`);
        $('.payInstallment').removeClass('d-none');
        $('.set_installment_amount').val(installmentAmount);
        $('.set_fixedInvest_amount').val(dataFixedAmount);
    } else {
        $('.totalInstallment').addClass('d-none');
        $('.installmentDuration').addClass('d-none');
        $('.installmentLateFee').addClass('d-none');
        $('.payInstallment').addClass('d-none');
    }
});

$(document).on('click', '#pay_installment', function () {
    if ($(this).prop("checked") == true) {
        $(this).val(1);
        let installmentAmount = $('.set_installment_amount').val();
        $('.invest-amount').val(installmentAmount);
        $('#amount').attr('readonly', true);
    } else {
        let fixedAmount = $('.set_fixedInvest_amount').val();
        $('.invest-amount').val(fixedAmount);
        $('#amount').attr('readonly', true);
        $(this).val(0);
    }

});
$(document).on('click', '.close_invest_modal', function () {
    if ($('#pay_installment').prop("checked") == true) {
        $("#pay_installment").prop("checked", false);
    }
});

