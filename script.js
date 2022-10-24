window.onload = function () {
  const selectedAlgorithm = document.getElementsByClassName("algoritma");
  const decryptText = document.getElementsByClassName("decrypt-text");
  const encryptText = document.getElementsByClassName("encrypt-text");

  const translatingText = async (text, action) => {
    const selectedAlgorithm =
      document.getElementsByClassName("algoritma")[0].value;

    const result = await fetch("/algorithm.php", {
      method: "POST",
      body: JSON.stringify({
        text: text,
        algoritma: selectedAlgorithm,
        action: action,
      }),
    }).then((res) => res.json());

    return result?.result;
  };

  document.addEventListener("translateText", async (event) => {
    const { action, text } = event.detail;

    await translatingText(text, action).then((result) => {
      if(!!result){
        if (action === "encrypt") {
          encryptText[0].value = result;
        } else {
          decryptText[0].value = result;
        }
      }
    });
  });

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
