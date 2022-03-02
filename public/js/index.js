const work_start = document.getElementById("work-start");
const work_end = document.getElementById("work-end");
const rest_start = document.getElementById("rest-start");
const rest_end = document.getElementById("rest-end");

work_start.addEventListener(click,()=>{
  work_start.disabled = true;
  work_end.disabled = false;
});
work_end.addEventListener('click', () => {
  work_start.disabled = false;
  work_end.disabled = true;
});
rest_end.addEventListener('click', () => {
  rest_start.disabled = true;
  rest_end.disabled = false;
});
rest_end.addEventListener('click', () => {
  rest_start.disabled = false;
  rest_end.disabled = true;
});