const memberItems = document.querySelectorAll(".member__item");
const overlayEl = document.querySelector(".overlay");

window.addEventListener("click", (e) => {
  e.preventDefault();
  if (e.target === overlayEl) {
    overlayEl.classList.remove("active");
  }
});

memberItems.forEach((memberItem) => {
  memberItem.addEventListener("click", () => {
    const id = memberItem.getAttribute("id");
    fetchMemberData(id);
  });
});

function fetchMemberData(memberId) {
  // Fetch data from the PHP backend using the GET method
  fetch(`getMember.php?id=${memberId}`)
    .then((response) => {
      if (!response.ok) {
        throw new Error("Network response was not ok");
      }
      return response.json();
    })
    .then((data) => {
      displayMemberCard(data);
    })
    .catch((error) => {
      console.error("Fetch error:", error);
    });
}

function displayMemberCard(memberData) {
  overlayEl.classList.add("active");

  let hobbies = "";

  memberData.hobbies.forEach((hobby) => {
    hobbies += `<li class="member-info__li">${hobby.hobby}</li>`;
  });
  overlayEl.innerHTML = `<div class="member-info__container">
                <?php $fullname =  $memberInfos['fName'] . " " . $memberInfos['lName']?>
                    <img class="member-info__img" src="./images/${memberData.memberInfos.image_path}" alt="${memberData.memberInfos.fName} ${memberData.memberInfos.lName}" />
                    <div class="member-info__container--info-div">
                            <label>Name:</label>
                            <p>${memberData.memberInfos.fName} ${memberData.memberInfos.lName}</p>
                            <label>Birthday: </label>
                            <p>${memberData.memberInfos.bday}</p>
                            <label>Age:</label>
                            <p>${memberData.memberInfos.age}</p>
                            <label>Hobbies:</label>
                            <ul class="member-info__ul">${hobbies}</ul>
                            <label>Quote: </label>
                            <p class="member-info--quote">"${memberData.memberInfos.quote}"</p>
                    </div>
            </div>`;
  const modal = overlayEl.querySelector(".member-info__container");
  modal.classList.add("active");
}
