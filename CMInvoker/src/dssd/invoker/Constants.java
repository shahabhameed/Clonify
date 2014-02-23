package dssd.invoker;

public class Constants {
	
	public static final String CM_INPUT_FOLDER = "input";
	public static final String CM_OUTPUT_FOLDER = "output";
	
	public static final String CM_INPUT_FILE_INPUTFILES = "InputFiles";
	public static final String CM_INPUT_FILE_EQUAL_TOKENS = "EqualTokens";
	public static final String CM_INPUT_FILE_CLUSTER_PARAMETERS = "ClusterParameters";
	public static final String CM_INPUT_FILE_SUPPRESSED = "Suppressed";
	
	public static final String CM_TEXT_FILE_EXTENSION = ".txt";
	
	public static final String CM_EXEC_FILE_NAME = "clones.exe";
	
	public static final String SIMPLE_CLONE_CLASSES_FILE_NAME = "Clones";
	public static final String INFILE_STRUCTURES_FILE_NAME = "InfileStructures";
	public static final String FILE_CLUSTERS_FILE_NAME ="FileClusters";
	public static final String CLONES_METHOD_FILE_NAME = "ClonesByMethod";
	
	public static final int DIR_FILE_VIEW = 0;
	public static final int FILE_METHOD_VIEW = 1;
	public static final int SCC_VIEW = 2;
	public static final int SCC_BYMETHOD_VIEW = 3;
	public static final int SCS_ACROSSMETHOD_VIEW = 4;
	public static final int MCC_VIEW = 5;
	public static final int MCC_BYFILE_VIEW = 6;
	public static final int MCS_ACROSSFILE_VIEW = 7;
	public static final int SCC_BYFILE_VIEW = 8;
	public static final int SCS_INFILE_VIEW = 9;
	public static final int SCS_ACROSSFILE_VIEW = 10;
	public static final int FCC_VIEW = 11;
	public static final int FCC_BYDIR_VIEW = 12;
	public static final int FCS_INDIR_VIEW = 13;
	public static final int FCS_ACROSSDIR_VIEW = 14;
	public static final int FCC_BYGROUP_VIEW = 15;
	public static final int FCS_INGROUP_VIEW = 16;
	public static final int FCS_ACROSSGROUP_VIEW = 17;
	public static final int GROUP_FILE_VIEW = 18;
	public static final int VIEW_SIZE = 19;

	public static final int METHOD_TYPE = 20;
	public static final int FILE_TYPE = 21;
	public static final int TOOLTIP_CLONE_CLASS = 22;
	public static final int TOOLTIP_CLONE_INSTANCE = 23;
	public static final int TOOLTIP_CLONE_STRUCTURE = 24;

	
	public static boolean isClassPresent(){
		return true;
	}

}
