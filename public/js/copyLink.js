function copyToClipboard() {
    var copyText = document.getElementById("referralLink");
    navigator.clipboard.writeText(copyText.value)
        .then(() => {
            //
        })
        .catch(err => {
            console.error('Could not copy text: ', err);
        });
}
