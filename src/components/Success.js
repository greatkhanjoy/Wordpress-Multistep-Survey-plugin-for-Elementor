import React, { useState } from "react";
import { __ } from "@wordpress/i18n";
import { Button } from "@wordpress/components";
import { withSelect } from "@wordpress/data";
import axios from "axios";

const Success = ({ data }) => {
  const [submitted, setSubmitted] = useState(false);

  const handleSendEmail = () => {
    console.log(data);
    const email = data.email; // Replace with your email data

    // Prepare the email parameters
    const emailData = {
      to: email,
      subject: __("Thanks for Completing the survey!", "gsurvey"),
      body: __("Survey complete! Thank you for your time.", "gsurvey"),
    };

    // Send the email

    axios
      .post("/wp-json/gsurvey/v1/send-email", emailData)
      .then(() => {
        setSubmitted(true);
        console.log("Email sent successfully.");
      })
      .catch((error) => {
        console.error("Failed to send email:", error);
      });
  };

  return (
    <div className="flex flex-col gap-3 p-4 min-h-[400px] justify-center mx-auto">
      <div className="flex flex-col gap-4 items-center justify-center">
        <h1 className="text-3xl leading-normal font-normal">
          {submitted
            ? "Survey complete! Thank you for your time."
            : "Almost There! Submit your Survey."}
        </h1>
        {!submitted && (
          <button
            onClick={handleSendEmail}
            type="button"
            className="inline px-6 py-2 text-lg border border-green-600 text-green-600 bg-transparent"
          >
            {" "}
            SUBMIT SURVEY
          </button>
        )}
      </div>
    </div>
  );
};

export default Success;
