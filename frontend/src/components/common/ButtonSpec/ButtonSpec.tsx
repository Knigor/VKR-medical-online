import styles from "./ButtonSpec.module.css";

type ButtonProps = {
  text: string;
};

export const ButtonSpec: React.FC<ButtonProps> = ({ text }) => {
  return (
    <div>
      <button
        className={`${styles.buttonProfile} hover:text-gray-700 text-base leading-6 font-bold hover:bg-gray-300 bg-pink-400 mt-[34px]`}
        type="button"
      >
        {text}
      </button>
    </div>
  );
};
