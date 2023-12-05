function updateTime() {
  const now = new Date();

  const dayName = now.toLocaleDateString("en-US", { weekday: "long" });
  const month = now.toLocaleDateString("en-US", { month: "long" });
  const dayNum = now.getDate();
  const year = now.getFullYear();

  const hour = now.getHours();
  const minutes = now.getMinutes();
  const seconds = now.getSeconds();
  const period = hour >= 12 ? "PM" : "AM";

  document.getElementById("dayname").textContent = dayName;
  document.getElementById("month").textContent = month;
  document.getElementById("daynum").textContent = dayNum;
  document.getElementById("year").textContent = year;
  document.getElementById("hour").textContent = hour % 12 || 12;
  document.getElementById("minutes").textContent = minutes
    .toString()
    .padStart(2, "0");
  document.getElementById("seconds").textContent = seconds
    .toString()
    .padStart(2, "0");
  document.getElementById("period").textContent = period;
}

// Call updateTime initially to avoid delay
updateTime();
// Update time every second (1000 milliseconds)
setInterval(updateTime, 1000);
