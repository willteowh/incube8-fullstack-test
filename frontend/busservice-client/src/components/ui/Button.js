import React, { useState } from "react";
import Loading from "./Loading";

const Button = ({ label = "", onClick }) => {
  const [loading, setLoading] = useState(false);

  const handleClick = async () => {
    setLoading(true);
    try {
      await onClick();
    } catch (error) {
      console.error("Error:", error);
    } finally {
      setLoading(false);
    }
  };

  return (
    <button
      onClick={handleClick}
      disabled={loading}
      className={`px-6 py-3 text-white bg-blue-500 rounded-md hover:bg-blue-700 ${
        loading ? "opacity-50 cursor-not-allowed" : ""
      }`}
    >
      {loading ? <Loading /> : label}
    </button>
  );
};

export default Button;
