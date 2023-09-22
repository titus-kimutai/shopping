require('./bootstrap');
document.getElementById('reverse').addEventListener('click', (event) => {
    event.preventDefault()

    const requestBody = {
        transactionid: document.getElementById('transactionid').value,
        amount: document.getElementById('amount').value,
    }

    axios.post('reversal', requestBody)
        .then((response) => {
            if (response.data) {
                document.getElementById('c2b_response').innerHTML = response.data.ResultDescription
            } else {
                document.getElementById('c2b_response').innerHTML = response.data.errorMessage
            }
        })
        .catch((error) => {
            console.log(error);
        })
})