import React, { useState, useEffect } from "react";
import styles from "./ProgressBar.module.css";

const ProgressBar = ({ value }) => {
  const [currentValue, setCurrentValue] = useState(0);

  useEffect(() => {

    const increaseValue = setTimeout(() => {

      setCurrentValue((prev) => prev + 1);

    }, 40);

    if (currentValue >= value) clearInterval(increaseValue);
    
  }, [currentValue]);

  return (
    <div className={styles.progressBar}>
      <div
        className={styles.value}
        style={{
          width: `${currentValue}%`,
          transition: `width ${(40 * value) / 1000}`,
        }}
      >
        
      </div>
      <div className={styles.valueText}>{currentValue}%</div>
    </div>
  );
};

export default ProgressBar;
