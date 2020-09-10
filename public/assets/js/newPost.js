const formFeed = document.querySelector("#form-new-feed");
const btnFeedSend = document.querySelector(".feed-new-send");
const inputFormFeed = document.querySelector("#input-body-feed");
const inputBodyFeed = document.querySelector(".feed-new-input");

btnFeedSend.addEventListener("click", (e) => {
  const valueBody = inputBodyFeed.innerText.trim();
  if (valueBody) {
    inputFormFeed.value = valueBody;
    formFeed.submit();
  }
});
