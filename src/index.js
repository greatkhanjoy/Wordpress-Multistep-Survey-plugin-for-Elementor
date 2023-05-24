import React, { useState, useEffect } from "react";
import ReactDOM from "react-dom";
import "./index.scss";
import ContactForm from "./components/ContactForm";
import Success from "./components/Success";
import Question from "./components/Question";

document.addEventListener("DOMContentLoaded", function () {
  // alert("Hello from React");
  const surveyDiv = document.querySelectorAll(".greatkhanjoy-survey-use");
  surveyDiv.forEach(function (div) {
    const data = JSON.parse(div.querySelector("pre").innerHTML);
    ReactDOM.render(<Survey data={data} />, div);
    div.classList.remove("greatkhanjoy-survey-use");
  });
});

const Survey = ({ data }) => {
  const [steps, setSteps] = useState(1);
  const [progress, setProgress] = useState(0);
  const [totalSteps, setTotalSteps] = useState(
    Number(data.question_list.length) + 2
  );

  const [formData, setFormData] = useState({
    first_name: "",
    last_name: "",
    country: "",
    increment: "",
    email: "",
    age: "",
    questions: data.question_list,
  });

  const updatePersonalInfo = (e) => {
    setFormData({
      ...formData,
      [e.target.name]: e.target.value,
    });
  };

  const formHandler = (e) => {
    e.preventDefault();
    setSteps(steps + 1);
  };

  const updateAnswer = (e, index) => {
    const newQuestions = [...formData.questions];
    newQuestions[index].answer = e;
    setFormData({
      ...formData,
      questions: newQuestions,
    });
  };

  useEffect(() => {
    setProgress(Math.round((steps / totalSteps) * 100));
  }, [steps]);

  return (
    <div className="w-full bg-gray-300 mx-auto">
      <form onSubmit={formHandler}>
        <div className="bg-gray-200 mx-auto p-5 w-full">
          <h2 className="text-center text-xl leading-normal font-medium">
            {data.title}
          </h2>
          <div className="w-full bg-gray-500 rounded-full dark:bg-gray-700">
            <div
              className="bg-blue-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full flex justify-center"
              style={{ width: `${progress}%` }}
            >
              {progress}%
            </div>
          </div>
        </div>
        <div className="survey_body py-4">
          {steps === 1 && (
            <ContactForm data={formData} onChange={updatePersonalInfo} />
          )}

          {formData.questions.map((question, index) => {
            return (
              steps === index + 2 && (
                <Question
                  data={question}
                  onChange={(e) => updateAnswer(e, index)}
                />
              )
            );
          })}

          {steps === totalSteps && <Success data={formData} />}
        </div>
        <div className="survey_footer flex justify-center gap-2 p-5 bg-gray-200">
          <button
            onClick={steps <= 1 ? null : () => setSteps(steps - 1)}
            type="button"
            disabled={steps <= 1}
            className={`bg-gray-300  px-6 py-2 ${
              steps <= 1 && "cursor-not-allowed opacity-50 :hover:bg-gray-300"
            }`}
          >
            BACKWARD
          </button>
          <button
            disabled={steps == totalSteps}
            type="submit"
            className={`bg-black text-white px-6 py-2 ${
              steps === totalSteps &&
              "cursor-not-allowed opacity-50 :hover:bg-black"
            }`}
          >
            FORWARD
          </button>
        </div>
      </form>
    </div>
  );
};
