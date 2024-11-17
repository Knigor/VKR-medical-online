import styles from "./ButtonProfile.module.css";

type ButtonProps = {
  text: string;
};

export const ButtonProfile: React.FC<ButtonProps> = ({ text }) => {
  return (
    <div>
      <button
        className={`${styles.buttonProfile} hover:bg-gray-300 decoration-gray-600 border-gray-300 `}
        type="button"
      >
        {text}
      </button>
    </div>
  );
};
