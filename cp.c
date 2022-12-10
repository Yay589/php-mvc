#include <sys/types.h>
#include <sys/stat.h>
#include <fcntl.h>
#include <unistd.h>
#include <stdio.h>
#include <stdlib.h>



#define SIZE_BUF 256

void usage(){
    printf("Bad argument\n command exemple : ./cp <source file> <destination file>\n");
}

void cp(char* src, char* dst){
    // check ...
    if ((access(src, F_OK)==-1) | (access(src, R_OK)==-1)){
        perror("Error source file");
        exit(EXIT_FAILURE);
    }

      if ((access(dst, F_OK)==0)){
        if ((access(dst, W_OK)==-1)){
            perror("Error source file");
            exit(EXIT_FAILURE);    
        }
    }

    if((access(".", W_OK)==-1)){
        perror("Error source file");
        exit(EXIT_FAILURE);
    }

    int f_src = open(src, O_RDONLY);
    if ((f_src==-1)){
        perror("Error source file");
        exit(EXIT_FAILURE);

    }

    int f_dst = open(dst, O_WRONLY | O_CREAT, 0666);
    if ((f_dst==-1)){
        perror("Error destination file");
        exit(EXIT_FAILURE);
    }

    char buf[SIZE_BUF+1];
    int octect_lu;
    while((octect_lu=read(f_src, buf, SIZE_BUF))){
            if(write(f_dst, buf,octect_lu )==-1)
                perror("Error write");
    }

}


int main(int argc, char** argv){
    if (argc != 3){
        usage();
        exit(EXIT_FAILURE);
    }
    cp(argv[1], argv[2]);

    return 0;
}