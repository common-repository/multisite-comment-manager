document.addEventListener("DOMContentLoaded", function () {
  const multiSiteCommentsElement = document.getElementById("multi-site-comments");
  const loadMoreCommentsButton = document.getElementById("load-more-comments");
  const commentDataArray = comment_management_plugin_globals.comments_html_array;
  let currentCommentDataArray = [...commentDataArray];
  let commentHtmlCurrentChunk = 0,
    currentIndex = 0,
    untilIndex = 0;

  displayDropDown();
  displayCommentsFromArray(currentCommentDataArray, commentHtmlCurrentChunk);

  loadMoreCommentsButton.addEventListener("click", event => {
    commentHtmlCurrentChunk += 1;
    displayCommentsFromArray(currentCommentDataArray, commentHtmlCurrentChunk);
  });

  document.getElementById("select-site").onchange = function () {
    console.log(commentDataArray);
    let selectedSite = this.value;
    let newCommentDataArray = commentDataArray[0].filter(isSelectedSite, selectedSite);
    currentCommentDataArray[0] = newCommentDataArray;
    commentHtmlCurrentChunk = 0;
    currentIndex = 0;
    untilIndex = 0;
    multiSiteCommentsElement.innerHTML = "";
    displayCommentsFromArray(currentCommentDataArray, commentHtmlCurrentChunk);
  };

  function displayCommentsFromArray(currentCommentDataArray, commentHtmlCurrentChunk) {
    currentIndex = commentHtmlCurrentChunk * 12;
    untilIndex = currentIndex + 13;
    currentDataArrayChunk = currentCommentDataArray[0].slice(currentIndex, untilIndex);
    if (currentDataArrayChunk == false) {
      loadMoreCommentsButton.innerHTML = "There are no more pending comments.";
      loadMoreCommentsButton.disabled = true;
      return;
    }
    currentDataArrayChunk.forEach(function (commentHtml) {
      const newDiv = document.createElement("div");
      newDiv.innerHTML = commentHtml[1];
      multiSiteCommentsElement.appendChild(newDiv);
    });
  }

  function isSelectedSite(element) {
    if (element[0] == this) {
      return true;
    }
    return false;
  }
});

function getPanelElements(uniqueId) {
  const panelUniqueId = uniqueId + "-panel";
  const titleId = uniqueId + "-title";
  const collapsibleElement = document.getElementById(uniqueId);
  const panelGroup = document.getElementById(panelUniqueId);
  const title = document.getElementById(titleId);
  return [collapsibleElement, panelGroup, title];
}

function displayDropDown() {
  const sitesDropdown = document.getElementById("sites-dropdown");
  const newDiv = document.createElement("div");
  newDiv.innerHTML = comment_management_plugin_globals.dropdown;
  sitesDropdown.appendChild(newDiv);
}
