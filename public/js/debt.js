function formatNumber(input) {
    // Remove any non-digit characters from the input value
    var value = input.value.replace(/\D/g, '');
  
    // Convert the value to a number and format it with commas
    var formattedValue = Number(value).toLocaleString();
  
    // Set the formatted value back to the input field
    input.value = formattedValue;
  }


  function amountToText(amount) {
    const digits = {
      0: "សូន្យ",
      1: "មួយ",
      2: "ពីរ",
      3: "បី",
      4: "បួន",
      5: "ប្រាំ",
      6: "ប្រាំមួយ",
      7: "ប្រាំពីរ",
      8: "ប្រាំបី",
      9: "ប្រាំបួន"
    };
  
    const specialCases = {
      10: "ដប់",
      20: "ម្ភៃ",
      30: "សាមសិប",
      40: "សែសិប",
      50: "ហាសិប",
      60: "ហុកសិប",
      70: "ចិតសិប",
      80: "ប៉ែតសិប",
      90: "កៅសិប"
    };
  
    function convertCurrencyToText(amount) {
      if (amount === 0) {
        return "សូន្យ រៀល";
      }
  
      let text = "";
      if (amount >= 1000000) {
        const millions = Math.floor(amount / 1000000);
        text += convertCurrencyToText(millions) + "លាន ";
        amount %= 1000000;
      }
  
      if (amount >= 10000) {
        const tenThousands = Math.floor(amount / 10000);
        text += convertCurrencyToText(tenThousands) + "ម៉ឺន ";
        amount %= 10000;
      }
  
      if (amount >= 1000) {
        const thousands = Math.floor(amount / 1000);
        text += convertCurrencyToText(thousands) + "ពាន់ ";
        amount %= 1000;
      }
  
      if (amount >= 100) {
        const hundreds = Math.floor(amount / 100);
        text += digits[hundreds] + "រយ ";
        amount %= 100;
      }
  
      if (amount > 20) {
        const tens = Math.floor(amount / 10) * 10;
        text += specialCases[tens] + "";
        amount %= 10;
      }
  
      if (amount > 0) {
        if (digits.hasOwnProperty(amount)) {
          text += digits[amount] + "";
        } else {
          text += specialCases[amount] + "";
        }
        
      }
  
      return text.trim();
    }
  
    return convertCurrencyToText(amount) + "រៀល";
  }

  function contentAboveTable(message, alertType){
    $('#contentAboveTable').empty();
    return $('#contentAboveTable').append(`<div class="alert ${alertType} alert-dismissible role="alert"><div>${message}</div><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>`);
  }

  function showDebtorSuggestion(dropdownOption) {
    // Clear previous options
    var dropdownOptions = $(dropdownOption);
    dropdownOptions.empty();
    for (var i = 0; i < suggestionDebtors.length; i++) {
      var option = suggestionDebtors[i];
      var listItem = $('<a>').addClass('dropdown-item').text(suggestionDebtors[i].name + " " + option.address)
          .attr('data-id', option.id);
      console.log(listItem);
      dropdownOptions.append(listItem);
    }
    dropdownOptions.show();
  }

  // When debtor name input on focus
  function getDebtor_onFocus(iconParrent, dropdownOption) {
    var spinner = $(`${iconParrent} i#iconSpinner`);
    var  check = $(`${iconParrent} i#iconCheck`);
    var  x = $(`${iconParrent} i#iconX`);
    spinner.show();
    check.hide();
    x.hide();
    $.ajax({
        url: "https://makaracoreapi.reanmakara.xyz/api/debtor/get",
        type: "GET",
        success: function(response) {
            console.log(response);
            if (response.status == 200) {
                check.show();
                suggestionDebtors = response.content;
            }
            showDebtorSuggestion(dropdownOption);
            spinner.hide();
        },
        error: function(error) {
            console.log(error);
            x.show();
            spinner.hide();
        }
    });   
  };
var suggestionDebtors = [];

function debtorFound(status, iconParrent){
  var spinner = $(`${iconParrent} i#iconSpinner`);
  var  check = $(`${iconParrent} i#iconCheck`);
  var  x = $(`${iconParrent} i#iconX`);
  if (status == '1') {
    check.show();
    x.hide();
  } else {
    check.hide();
    x.show();
  }
}
  // Show select option under input
  function debtorSuggestion(elementId, inputTextId, iconParrent) {
    var inputText = $(inputTextId).val().toLowerCase();
    var dropdownOptions = $(elementId);
    // Clear previous options
    dropdownOptions.empty();

    // Generate and append new options
    for (var i = 0; i < suggestionDebtors.length; i++) {
        var option = suggestionDebtors[i];
        var optName = option.name.toLowerCase();
        if (optName.includes(inputText)) {
            var listItem = $('<a>').addClass('dropdown-item').text(suggestionDebtors[i].name + " " + option.address)
                .attr('data-id', option.id);
            console.log(listItem);
            dropdownOptions.append(listItem);
        }
    }

    // Show or hide dropdown options based on the input text
    if (inputText.length > 0 && dropdownOptions.children().length > 0) {
        dropdownOptions.show();
        debtorFound(1, iconParrent);
    }
    else if( inputText.length == 0 && suggestionDebtors.length > 0){
      dropdownOptions.show();
      debtorFound(1, iconParrent);
    } else {
      debtorFound(0, iconParrent);
      dropdownOptions.hide();
    }
  }
  

  // function newDebtor(){
  //   // Call post request to add new debtor to server
  //   $('#btnSaveDebtorText').html('កំពុករក្សាទុក...');
  //   $('#btnSaveDebtorSpinner').show();
  //   $('#btnSaveDebtor').prop('disabled', true);
  //   $.post("https://makaracoreapi.reanmakara.xyz/api/debtor/add", {
  //   name: $("#debtorName").val(),
  //   address: $("#debtorAddress").val(),
  //   sex: $("#debtorSex").val()
  // }
  //   ).done(function(data) {
  //     console.log(data);
  //     // close modal
  //     // $('#btnSaveDebtorSpinner').hide();
  //     // $("#closeMedal").click();
  //     if (data.status == 201) {
  //       $('#btnSaveDebtorSpinner').hide();
  //       $("#closeMedal").click();
  //       $('#newDebtAlertMessage').append('<div class="alert alert-success alert-dismissible role="alert"><div>បង្កើតអ្នកជំពាក់បានដោយជោគជ័យ។ សរសេរឈ្មោះអ្នកជំពាក់ខាងក្រោម</div><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>').delay(5000).fadeOut(1000);
  //       //$('#newDebtAlertMessage').append('<div>').addClass('alert alert-success alert-dismissible').html('បង្កើតអ្នកជំពាក់បានដោយជោគជ័យ។ សរសេរឈ្មោះអ្នកជំពាក់ខាងក្រោម').addRole('alert');
  //     }
  //     else{
  //       window.alert(data);
  //     }
  //   }
  //   ).fail(function(data) {
  //     console.log(data);
  //     window.alert("រក្សាទុកទិន្ន័យបរាជ័យ");
  //     $('#btnSaveDebtorSpinner').hide();
  //     $('#btnSaveDebtor').prop('disabled', false);
  //     $('#btnSaveDebtorText').html('រក្សាទុក');
  //     $("#closeMedal").click();
  //     $('#newDebtAlertMessage').append('<div class="alert alert-danger alert-dismissible role="alert"><div>បង្កើតអ្នកជំពាក់មិនជោគជ័យ</div><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>').delay(5000).fadeOut(1000);
  //     //$('#newDebtAlertMessage').append('<button class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>').addClass('alert alert-danger alert-dismissible').html('បង្កើតអ្នកជំពាក់មិនជោគជ័យ').addRole('alert');
  //     // $('#newDebtAlertMessageDiv').append('<button>').addClass('btn-close').attr('data-bs-dismiss', 'alert').attr('aria-label', 'Close');
  //     //$("#myElement").delay(duration)
  //   }
  //   );
  // }

  async function newDebtor() {
    try {
      // Call post request to add new debtor to server
      $('#btnSaveDebtorText').html('កំពុករក្សាទុក...');
      $('#btnSaveDebtorSpinner').show();
      $('#btnSaveDebtor').prop('disabled', true);
  
      const response = await $.post("https://makaracoreapi.reanmakara.xyz/api/debtor/add", {
        name: $("#debtorName").val(),
        address: $("#debtorAddress").val(),
        sex: $("#debtorSex").val()
      });
  
      console.log(response);
  
      if (response.status == 201) {
        $('#btnSaveDebtorSpinner').hide();
        $("#closeMedal").click();
        $('#newDebtAlertMessage').append('<div class="alert alert-success alert-dismissible role="alert"><div>បង្កើតអ្នកជំពាក់បានដោយជោគជ័យ។ សរសេរឈ្មោះអ្នកជំពាក់ខាងក្រោម</div><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>').delay(5000).fadeOut(1000);
      } else {
        window.alert(response);
      }
    } catch (error) {
      console.log(error);
      window.alert("រក្សាទុកទិន្ន័យបរាជ័យ");
      $('#btnSaveDebtorSpinner').hide();
      $('#btnSaveDebtor').prop('disabled', false);
      $('#btnSaveDebtorText').html('រក្សាទុក');
      $("#closeMedal").click();
      $('#newDebtAlertMessage').append('<div class="alert alert-danger alert-dismissible role="alert"><div>បង្កើតអ្នកជំពាក់មិនជោគជ័យ</div><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>').delay(5000).fadeOut(1000);
      location.reload();
    }
  }

  // Create function for request post to create new debt

  async function newDebt_Clicked() {
    // Validate amount input
    var amountInput = document.getElementById('amount');
    if (amountInput.value === '') {
        amountInput.setCustomValidity('ចំនួនទឹកប្រាក់ត្រូវតែបញ្ជូលជាចាំបាច់');
    } else {
        amountInput.setCustomValidity('');
    }
    // Call post request to add new debt to server
    $('#addNewDebt').html('កំពុងបន្តែម...');
    $('#btnSaveDebtSpinner').show();
    $('#addNewDebt').prop('disabled', true);
  
    var response = await $.post("https://makaracoreapi.reanmakara.xyz/api/debt/add", {
      debtor_id: $("#debtorId").val(),
      amount: $("#amount").val(),
      note: $("#txtNote").val(),
    });
    console.log(response);
      if (response.status == 201) {
        var message = 
        `មានវិក្តយបត្រថ្មី 🔔
----------------------------------
អតិថិជន  : ${$('#debtor').val()}
ទឺកប្រាក់  : ${$('#amount').val()} រៀល
ចំណាំ     : ${$('#txtNote').val()}
តាមរយៈ : Website
----------------------------------
សូមប៉ាប៉ា ម៉ាក់ម៉ាក់ជ្រាបជាដំណឹង 🔊🔔
        `
        await sendMessageToTelegramGroup(telegramGroupId, message);
        $('#btnSaveDebtSpinner').hide();
        $('#addNewDebt').html('បន្តែម');
        // show success message
        $('#newDebtAlertMessage').append('<div class="alert alert-success alert-dismissible role="alert"><div>បង្កើតកំណត់ត្រាជំពាក់បានដោយជោគជ័យ</div><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>').delay(5000).fadeOut(1000);
        location.reload();
      }
      else{

      }
  }

  function updateDebtAmount(){
    var table = $('#tableBody tr').filter(function() {
      return $(this).css('display') != 'none';
    });
    let totalAmount = 0;
    let unpaidAmount = 0;
    let paidAmount = 0;
    let unpaidCount = 0;
    let paidCount = 0;
    if (table.length == 0){
      $('#totalDebtAmount').html('0');
      $('#unpaidDebtAmount').html('0');
      $('#paidDebtAmount').html('0');
      return;
    }
    // Loop through all table rows
    for (let index = 0; index < table.length; index++) {
      // Get value from table cell amount
      totalAmount += parseInt(table[index].children[4].textContent.replace(/\D/g, ''));

      // Check if debt is paid (check on classname)
      if (table[index].classList.contains('text-decoration-line-through')){
        paidAmount += parseInt(table[index].children[4].textContent.replace(/\D/g, ''));
        paidCount++;
      }
      else{
        unpaidAmount += parseInt(table[index].children[4].textContent.replace(/\D/g, ''));
        unpaidCount++;
      }
    }
    $('#totalDebtAmount').html(`${Number(totalAmount).toLocaleString()} (${amountToText(totalAmount)}) ${unpaidCount + paidCount} វិក្តយបត្រ`);
    $('#unpaidDebtAmount').html(`${Number(unpaidAmount).toLocaleString()} (${amountToText(unpaidAmount)}) ${unpaidCount} វិក្តយបត្រ`);
    $('#paidDebtAmount').html(`${Number(paidAmount).toLocaleString()} (${amountToText(paidAmount)}) ${paidCount} វិក្តយបត្រ`);
  }

  function searchTable(value){
    var table = $('#tableBody tr');
    let totalAmount = 0;
    let unpaidAmount = 0;
    let paidAmount = 0;
    for (let index = 0; index < table.length; index++) {
      for (let i = 0; i < table[index].children.length; i++) {
        if(table[index].children[i].innerText.toLowerCase().includes(value.toLowerCase())){
          table[index].style.display = "";
          // Get value from table cell amount
          totalAmount += parseInt((table[index].children[4].innerText).replace(/\D/g, ''));
          // Check if debt is paid (check on classname)
          if (table[index].classList.contains('text-decoration-line-through')){
            paidAmount += parseInt((table[index].children[4].innerText).replace(/\D/g, ''));
          }
          else{
            unpaidAmount += parseInt((table[index].children[4].innerText).replace(/\D/g, ''));
          }
          break;
        }
        else{
          table[index].style.display = "none";
        }
      }
    }
    $('#loading').hide();
    updateDebtAmount();
  }

  // async function pay(debtorId){
  //   await $.ajax({
  //     url: 'https://makaracoreapi.reanmakara.xyz/api/debt/get',
  //     type: 'GET',
  //     data: {
  //       debtor_id: debtorId,
  //       is_paid: 0,
  //     },
  //     success: function(response){
  //       response.content.forEach(function(debt){
  //         $.ajax({
  //           url: 'https://makaracoreapi.reanmakara.xyz/api/debt/pay',
  //           type: 'PUT',
  //           data: {
  //             id: debt.id
  //           },
  //           success: function(response){
  //             console.log(response);
  //             return response;
  //           },
  //           error: function(error){
  //             console.log(error);
  //             return error.responseJSON;
  //           }
  //         });
  //       });
  //     },
  //     error: function(error){
  //       console.log(error);
  //       return error.responseJSON;
  //     }
  //   });
  // }

  async function pay(debtorId) {
    try {
      const response = await $.ajax({
        url: 'https://makaracoreapi.reanmakara.xyz/api/debt/get',
        type: 'GET',
        data: {
          debtor_id: debtorId,
          is_paid: 0,
        }
      });
  
      for (const debt of response.content) {
        const paymentResponse = await $.ajax({
          url: 'https://makaracoreapi.reanmakara.xyz/api/debt/pay',
          type: 'PUT',
          data: {
            id: debt.id
          }
        });
  
        console.log(paymentResponse);
        // You can do further processing with paymentResponse if needed
      }
  
      return response; // Returning the initial response
    } catch (error) {
      console.log(error);
      return error.responseJSON; // Returning the error response
    }
  }

  $(document).on('input',  '#txtAmountPaySome', function(){
    var newDebtAmount = parseInt(($('#amountToPay').val().replace(/\D/g, ''))) - $(this).val();
    $('#txtNewDebtAmount').val(Number(newDebtAmount).toLocaleString()+' រៀល');
  });
  

  $(document).on('input', '#txtSearch', function(){
    searchTable($(this).val());
  });

  $(document).on('click', '#btnPay', function(){
    var debtor = $('#debtorToPay').val();
    $('#payMedalTitle').html(debtor + ' ពិតជាបានមកទូទាត់');
  });

$(document).on('click', '#btnPayDebt', async function(){
    var debtorId = $('#debtorToPayId').val();
    var amountPaySome = $('#txtAmountPaySome').val();
    var amountToPay = $('#amountToPay').val();
    var newDebtAmount = $('#amountToPay').data('amount') - amountPaySome;
    var debtorName = $('#debtorToPay').val();
    // Check if pay some
    if ($('#paySomeCheckbox').prop('checked')) {
      $('#btnPayDebtSpinner').show();
      var res = await pay(debtorId);
      if (res.status == 200){
        var response = await $.post("https://makaracoreapi.reanmakara.xyz/api/debt/add", {
          debtor_id: debtorId,
          amount: newDebtAmount,
          note: `មកទូទាត់ខ្លះចំនួន ${amountPaySome} រៀល។ នៅជំពាក់ ${newDebtAmount}`,
        });
        console.log(response);
        if (response.status == 201) {
          const message = 
          `មានអតិថិជនបានមកទូទាត់ខ្លះ 🔔🤑
---------------------------------
អតិថិជន : ${debtorName}
ជំពាក់សរុប : ${amountToPay}
បានទូទាត់ : ${Number(amountPaySome).toLocaleString()} រៀល
នៅជំពាក់ : ${Number(newDebtAmount).toLocaleString()} រៀល
តាមរយៈ : Website
---------------------------------
សូមប៉ាប៉ា ម៉ាក់ម៉ាក់ជ្រាបជាដំណឹង 🔊🔔
          `
          await sendMessageToTelegramGroup(telegramGroupId, message)
          // show success message
          $('#btnPayDebtSpinner').hide();
          $('#closePayMedal').click();
          $('#debtorToPay').val('');
          $('#debtorToPay').prop('disabled', false);
          $('#debtorToPayId').val('');
          $('#amountToPay').val('');
          $('#txtDebtCount').val('');
          $('#payDebtAlertMessage').append('<div class="alert alert-success alert-dismissible role="alert"><div>ការទូទាត់បានដោយជោគជ័យ</div><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>').delay(5000).fadeOut(1000);
          location.reload();
        }
        else{
          $('#payDebtAlertMessage').append('<div class="alert alert-danger alert-dismissible role="alert"><div>ការទូទាត់បានបរាជ័យ</div><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>').delay(5000).fadeOut(1000);
        }
      }
    }
    else{
      $('#btnPayDebtSpinner').show();
      var res = await pay(debtorId);
      if (res.status == 200){
        const message = `
        មានអតិថិជនមកទូទាត់វិក្តបត្រ 💵✅
--------------------------------------
អតិថិជន : ${debtorName}
ទឹកប្រាក់ដែលបានទូទាត់់ : ${amountToPay}
តាមរយៈ : Website
---------------------------------------
សូមប៉ាប៉ា ម៉ាក់ម៉ាក់ជ្រាបជាដំណឹង 🔊🔔
        `
        await sendMessageToTelegramGroup(telegramGroupId, message);
        $('#btnPayDebtSpinner').hide();
        $('#closePayMedal').click();
        $('#payDebtAlertMessage').append('<div class="alert alert-success alert-dismissible role="alert"><div>ទូទាត់បំណុលបានដោយជោគជ័យ</div><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>').delay(5000).fadeOut(1000);
        $('#debtorToPay').val('');
        $('#debtorToPay').prop('disabled', false);
        $('#debtorToPayId').val('');
        $('#amountToPay').val('');
        $('#txtDebtCount').val('');
        location.reload();
      }
      else{
        $('#payDebtAlertMessage').append(`<div class="alert alert-danger alert-dismissible role="alert"><div>${res.message}</div></div>`);
      }
    }
  });

  function search(){
    var fromDate = $('#d1').val();
    var toDate = $('#d2').val();
    var selectDebt = $('#selectDebt').val();
    var params = {
      d1: fromDate || undefined,
      d2: toDate || undefined,
      is_paid: null
    };

    if (selectDebt === 'Paid') {
      params.is_paid = 1;
    } else if (selectDebt === 'Unpaid') {
      params.is_paid = 0;
    }
    else{
      params.is_paid = undefined;
    }
    $('#tableBody').empty();
    $('#loading').show();
    $.ajax({
      url: "https://makaracoreapi.reanmakara.xyz/api/debt/get",
      type: 'GET',
      data: params,
      success: function(data){
        let debtorRow = '';
        let rowNum = 1;
          data.content.forEach(function(debt) {
            if (debt.is_paid) {
              debtorRow = `<tr class="table-success text-decoration-line-through">
                  <th>${rowNum}</th>
                  <th>${debt.debtor.name}</th>
                  <th>${debt.debtor.sex}</th>
                  <th>${debt.debtor.address}</th>
                  <th>${Number(debt.amount).toLocaleString()} រៀល</th>
                  <th>${debt.note || ""}</th>
              </tr>`;
            } else {
              debtorRow = `<tr class="table-warning">
                  <th>${rowNum}</th>
                  <th>${debt.debtor.name}</th>
                  <th>${debt.debtor.sex}</th>
                  <th>${debt.debtor.address}</th>
                  <th>${Number(debt.amount).toLocaleString()} រៀល</th>
                  <th>${debt.note || ""}</th>
              </tr>`;
            }
          rowNum++;
          $('#tableBody').append(debtorRow);
        });
        $('#txtSearch').val('');
        $('#loading').hide();
        updateDebtAmount();
      },
      error: function(error){
        if (error.responseJSON.status == 404){
          contentAboveTable(`មិនមានទិន្នន័យ! || ${error.responseJSON.message}`, 'alert-danger')
          $('#loading').hide();
          updateDebtAmount();
        }
      }
    });
    
  }

  // Hide dropdown when click outside of it and input
  $(document).on('click', function(event) {
    if (
      !$(event.target).closest('#debtor, #dropdownOptions').length &&
      !$(event.target).closest('#debtorToPay, #dropdownOptionDebt').length
    ) {
      $('#dropdownOptions').hide();
      $('#span-debtor i').hide();
      $('#dropdownOptionDebt').hide();
      $('#span-debt i').hide();
    }
  });

  const telegramBotToken = '5752204112:AAHR4w3ZpFYkuW7TqTzCBpqJ9gwmKv8huRo';
  const telegramGroupId = '-1001839510943';
  // Send message to telegram group
  async function sendMessageToTelegramGroup(groupId, message) {
    await $.ajax({
      url: `https://api.telegram.org/bot${telegramBotToken}/sendMessage`,
      type: 'POST',
      data: {
        chat_id: groupId,
        text: message,
      },
      success: function(data) {
        console.log(data);
      },
      error: function(error) {
        console.log(error);
      },
    });
  }
  
  
   