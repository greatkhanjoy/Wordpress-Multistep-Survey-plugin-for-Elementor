import React, { useState, useEffect } from "react";

const Question = ({ data, onChange }) => {
  const [multipleChoice, setMultipleChoice] = useState(data.multiple_answer);
  const [newAnswer, setNewAnswer] = useState(data?.answer || []);

  const answerHandler = (e) => {
    if (data.question_type == "checkbox" && multipleChoice === "yes") {
      // remove or add answer
      if (newAnswer.includes(e.target.value)) {
        let answer = [...newAnswer];
        answer = answer.filter((item) => item !== e.target.value);
        setNewAnswer(answer);
      } else {
        setNewAnswer([...newAnswer, e.target.value]);
      }
    } else {
      setNewAnswer([e.target.value]);
    }
  };

  useEffect(() => {
    onChange(newAnswer);
  }, [newAnswer]);
  return (
    <div className="flex flex-col gap-3 p-4">
      <h3 className="text-xl leading-normal font-semibold">{data.question}</h3>
      <div className="flex flex-col gap-4">
        {data.options.map((option, index) => {
          return data.question_type == "radio" ? (
            <label
              key={index}
              className="flex gap-2 items-center cursor-pointer"
            >
              <input
                type="radio"
                name={data.question}
                value={option.option}
                onChange={answerHandler}
                checked={newAnswer.includes(option.option)}
                required
              />
              <span>{option.option}</span>
            </label>
          ) : data.question_type == "checkbox" ? (
            <label
              key={index}
              className="flex gap-2 items-center  cursor-pointer"
            >
              <input
                type="checkbox"
                name={`${data.question}_${index}`}
                value={option.option}
                onChange={answerHandler}
                checked={newAnswer.includes(option.option)}
                required={newAnswer.length === 0}
              />
              <span>{option.option}</span>
            </label>
          ) : null;
        })}
      </div>
    </div>
  );
};

export default Question;
