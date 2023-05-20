const triggerTabList = document.querySelectorAll('#myTab a')
triggerTabList.forEach(triggerEl => {
    const tabTrigger = new bootstrap.Tab(triggerEl)

    triggerEl.addEventListener('click', event => {
        event.preventDefault()
        tabTrigger.show()
    })
});

$(document).on('click', '#paySomeCheckbox', function(){
    // Check if checkbox is checked
    if($(this).is(':checked')){
        // Show the element
        $('#divPaySome').show();
    }
    else{
        $('#divPaySome').hide();
    }
});

$(document).ready(function(){
    // Make http request to get all the debtors and add them to table
    $.ajax({
        url: "/debt/all",
        type: "GET",
        success: function(response) {
            console.log(response.content);

            function addDebtorToTable(debtor) {
                let debtorRow = `<tr>
                                    <th>${debtor.id}</th>
                                    <th>${debtor.amount}</th>
                                    <th>${debtor.is_paid ? 'Paid' : 'Not Paid'}</th>
                                </tr>`;
                $('#tableBody').append(debtorRow);
            }

            if (response.status == 200) {
                // Foreach debtor in the response content, add it to the table
                response.content.forEach(debtor => {
                    addDebtorToTable(debtor);
                });
            }
        },
        error: function(error){
            console.log(error);
        }

    });
});


$(document).on('click', '#newDebt', function(){
    $.ajax({
        url: "/debtor/get",
        type: "GET",
        success: function(response) {
            console.log(response);
            if (response.status == 200) {
                suggestionDebtors = response.content;
            }
        },
        error: function(error){
            console.log(error);
        }

    });
});
var suggestionDebtors = [];
