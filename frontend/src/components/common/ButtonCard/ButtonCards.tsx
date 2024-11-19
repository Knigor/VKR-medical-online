import styles from "./ButtonCards.module.css";

type ButtonProps = {
  text: string;
};

export const ButtonCards: React.FC<ButtonProps> = ({ text }) => {
  return (
    <div>
      <button
        className={`${styles.buttonProfile} hover:bg-pink-300 decoration-gray-600 border-gray-300 `}
        type="button"
      >
        {text}
      </button>
    </div>
  );
};
