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
	public static final String TEST_FILE_NAME ="FileClusters_test";
        
	public static final String SIMPLE_CLONE_CLASSES_FILE_NAME = "Clones";
	
	public static final String CLONES_BY_FILE_FILE_NAME = "ClonesByFile";
	public static final String CLONES_BY_FILE_TABLE_NAME = "clones_by_file";
	
	public static final String CLONES_BY_FILE_NORMAL_FILE_NAME = "ClonesByFileNormal";
	public static final String CLONES_BY_FILE_NORMAL_TABLE_NAME = "clones_by_file_normal";
	
	public static final String CLONES_BY_METHOD_FILE_NAME = "ClonesByMethod";
	public static final String CLONES_BY_METHOD_TABLE_NAME = "clones_by_method";
	
	public static final String CLONES_BY_METHOD_NORMAL_FILE_NAME = "ClonesByMethodNormal";
	public static final String CLONES_BY_METHOD_NORMAL_TABLE_NAME = "clones_by_method_normal";
	
	public static final String CLONES_RNR_FILE_NAME = "ClonesRNR";
	public static final String CLONES_RNR_TABLE_NAME = "clones_rnr";
	
	public static final String INFILE_STRUCTURES_FILE_NAME = "InfileStructures";
	public static final String FILE_CLUSTERS_FILE_NAME ="FileClusters";
	public static final String CLONES_METHOD_FILE_NAME = "ClonesByMethod";
	
	public static final String IN_DIR_STRUCTURE = "InDirsCloneFileStructures";
	public static final String IN_GROUP_STRUCTURE = "InGroupCloneFileStructures";
	public static final String CROSS_DIR_FILE_EX = "CrossDirsCloneFileStructuresEx";
	public static final String FILE_STRUCTURE_CROSS_GROUP = "CrossGroupsCloneFileStructuresEx";
	public static final String FILE_CLUSTER_XX = "FileClustersXX";
	public static final String FILE_CLONES_BY_DIR = "FileClonesByDirs";
        
        public static final String FILE_CLONES_BY_GROUPS = "FileClonesByGroups";
        
	public static final String METHOD_CLUSTER_XX_FILE_NAME = "MethodClustersXX";
	public static final String METHOD_STRUCTURE_FILE_NAME = "CrossFileCloneMethodStructuresEx";

	public static final String METHOD_INFO_FILE_NAME = "MethodsInfo";
	public static final String FILE_INFO_FILE_NAME = "FilesInfo";
	
	public static final String METHOD_CLUSTER_FILE_NAME = "MethodClusters";
	public static final String METHOD_CLONES_BY_FILE_FILE_NAME = "MethodClonesByFiles";
	
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
	
	/**
	 * In order to run normally the value of SHOULD_USE_OLD_RESULTS should be false
	 */
	public static final boolean SHOULD_USE_OLD_RESULTS = false;

	
	public static boolean isClassPresent(){
		return true;
	}

}
