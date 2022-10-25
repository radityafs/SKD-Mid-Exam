window.onload = function () {
  const selectedAlgorithm = document.getElementsByClassName("algoritma");
  const decryptText = document.getElementsByClassName("decrypt-text");
  const encryptText = document.getElementsByClassName("encrypt-text");


  function debounce(func, timeout = 500) {
    let timer;
    return (...args) => {
      clearTimeout(timer);
      timer = setTimeout(() => { func.apply(this, args); }, timeout);
    };
  }


  const translatingText = async (text, action) => {
    const selectedAlgorithm =
      document.getElementsByClassName("algoritma")[0].value;

    const result = await fetch("./algorithm.php", {
      method: "POST",
      body: JSON.stringify({
        text: text,
        algoritma: selectedAlgorithm,
        action: action,
      }),
    }).then((res) => res.json());

    if (result.error) {
      Toastify({
        text: result?.error,
        duration: 3000,
        newWindow: true,
        close: true,
        gravity: "top",
        position: "right",
        backgroundColor: "red",
        stopOnFocus: true,
      }).showToast();

      return false
    }
    return result?.result;
  };

  document.addEventListener("translateText", debounce(async (e) => {
    const { action, text } = e.detail;
    const result = await translatingText(text, action);
    if (result) {
      Toastify({
        text: "Berhasil",
        duration: 3000,
        newWindow: true,
        close: true,
        gravity: "top",
        position: "right",
        backgroundColor: "green",
        stopOnFocus: true,
      }).showToast();

      if (action === "encrypt") {
        encryptText[0].value = result;
      } else {
        decryptText[0].value = result;
      }
    }
  }, 500));

  selectedAlgorithm[0].addEventListener("change", function () {
    const event = new CustomEvent("translateText", {
      detail: {
        text: decryptText[0].value,
        action: "encrypt",
      },
    });

    document.dispatchEvent(event);
  });

  decryptText[0].addEventListener("keyup", async function () {
    const event = new CustomEvent("translateText", {
      detail: {
        text: decryptText[0].value,
        action: "encrypt",
      },
    });

    document.dispatchEvent(event);
  });

  encryptText[0].addEventListener("keyup", async function () {
    const event = new CustomEvent("translateText", {
      detail: {
        text: encryptText[0].value,
        action: "decrypt",
      },
    });

    document.dispatchEvent(event);
  });
};
