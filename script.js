document.getElementById('convert-form').addEventListener('submit', function(e) {
  e.preventDefault();
  const url = document.getElementById('youtube-url').value;
  const resultDiv = document.getElementById('result');
  resultDiv.innerHTML = "Converting... Please wait.";

  fetch('convert.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
    body: 'url=' + encodeURIComponent(url)
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      resultDiv.innerHTML = `<p>✅ Conversion successful!</p>
                             <p><a href="${data.downloadUrl}" target="_blank" rel="noopener noreferrer">Download MP3</a></p>`;
    } else {
      resultDiv.innerHTML = `<p>❌ Error: ${data.error}</p>`;
    }
  })
  .catch(error => {
    resultDiv.innerHTML = `<p>❌ An error occurred. Please try again.</p>`;
    console.error(error);
  });
});
