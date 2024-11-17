import React, { useState } from "react";
import styles from "./Slider.module.css";

type SliderProps = {
  items: string[]; // Массив с элементами слайдера
};

export const Slider: React.FC<SliderProps> = ({ items }) => {
  const [currentIndex, setCurrentIndex] = useState(0);

  const handlePrev = () => {
    setCurrentIndex(
      (prevIndex) => (prevIndex - 1 + items.length) % items.length
    );
  };

  const handleNext = () => {
    setCurrentIndex((prevIndex) => (prevIndex + 1) % items.length);
  };

  return (
    <div className={styles.slider}>
      <button
        className={`${styles.slider_button} ${styles.left}`}
        onClick={handlePrev}
      >
        &#10094;
      </button>
      <div className={styles.slider_content}>
        {items.map((item, index) => (
          <div
            key={index}
            className={`${styles.slider_item} ${
              index === currentIndex ? styles.active : ""
            }`}
          >
            {item}
          </div>
        ))}
      </div>
      <button
        className={`${styles.slider_button} ${styles.right}`}
        onClick={handleNext}
      >
        &#10095;
      </button>
    </div>
  );
};
