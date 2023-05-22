function formatNumber(input) {
    // Remove any non-digit characters from the input value
    var value = input.value.replace(/\D/g, '');
  
    // Convert the value to a number and format it with commas
    var formattedValue = Number(value).toLocaleString();
  
    // Set the formatted value back to the input field
    input.value = formattedValue;
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
      amount: $("#amount").val()
    });
    console.log(response);
      if (response.status == 201) {
        $('#btnSaveDebtSpinner').hide();
        $('#addNewDebt').html('បន្តែម');
        // show success message
        $('#newDebtAlertMessage').append('<div class="alert alert-success alert-dismissible role="alert"><div>បង្កើតកំណត់ត្រាជំពាក់បានដោយជោគជ័យ</div><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>').delay(5000).fadeOut(1000);
        location.reload();
      }
      else{

      }
  }
  
  
   